<?php

namespace App\Modules\Seller\Http\Controllers\Func;

use App\Functions\Common;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Freight;
use App\Models\GoodsSpec;
use App\Models\GoodsUnit;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\AttributeRepository;
use App\Repositories\AttrValueRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\FreightRepository;
use App\Repositories\GoodsAttrRepository;
use App\Repositories\GoodsImageRepository;
use App\Repositories\GoodsLayoutRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\GoodsSkuRepository;
use App\Repositories\GoodsSpecRepository;
use App\Repositories\ShopCategoryRepository;
use App\Repositories\ShopContractRepository;
use App\Repositories\SpecAliasRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GoodsController extends Seller
{
    protected $category;

    protected $shopCategory;

    protected $attribute;

    protected $attrValue;

    protected $goods;

    protected $goodsImage;

    protected $freight; // 运费模板

    protected $shopContract;

    protected $goodsLayout;

    protected $goodsAttr;

    protected $goodsSpec;

    protected $specAlias;

    protected $goodsSku;

    protected $common;

    public function __construct(
        CategoryRepository $categoryRepository,
        AttributeRepository $attributeRepository,
        AttrValueRepository $attrValueRepository,
        GoodsRepository $goodsRepository,
        GoodsImageRepository $goodsImageRepository,
        FreightRepository $freightRepository,
        Common $common
    )
    {
        parent::__construct();

        $this->shopCategory = new ShopCategoryRepository();
        $this->category = $categoryRepository;
        $this->attribute = $attributeRepository;
        $this->attrValue = $attrValueRepository;
        $this->goods = $goodsRepository;
        $this->goodsImage = $goodsImageRepository;
        $this->freight = $freightRepository;
        $this->shopContract = new ShopContractRepository();
        $this->goodsLayout = new GoodsLayoutRepository();
        $this->goodsAttr = new GoodsAttrRepository();
        $this->goodsSpec = new GoodsSpecRepository();
        $this->specAlias = new SpecAliasRepository();
        $this->goodsSku = new GoodsSkuRepository();
        $this->common = new Common();

        $this->set_menu_select('goods', 'goods-publish');
    }

    public function get_merchant()
    {
        #获取当前商户的企业
        $manage = Db::connection('shop_db')->table('centralize_manage_person')->where(['id'=>Session('seller.mid')])->first();
        return $manage;
    }

    public function goods_manage(Request $request)
    {
        $data = $request->except(['_token']);

        if (isset($data['pa'])) {
            $limit = $request->get('limit');
            $page = $request->get('page') - 1;
            if ($page != 0) {
                $page = $limit * $page;
            }
            $keyword = $request->get('keywords') ? $request->get('keywords') : '';

            $manage = $this->get_merchant();

            $where = [];
            $where[] = ['shop_id', session('shop_info')->shop_id];
            $where[] = ['is_delete', 0]; // 查询删除状态为0的商品

            $count = Db::table('goods')->where($where)->count();
            $rows = DB::table('goods')->where($where)
                ->offset($page)
                ->limit($limit)
                ->orderBy('goods_id', 'desc')
                ->get()
                ->toArray();

            $rows = objtoarr($rows);

            $_status = ['-1'=>'已下架','0'=>'待审核','1'=>'已上架'];
            foreach ($rows as &$item) {
                $item['status_name'] = $_status[$item['goods_status']];
                if ($item['goods_audit']==0 && $item['goods_status']==1) {
                    $item['status_name'] .= '待审核';
                }
            }

            return response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
        } else {
            return view('func.goods.goods_manage', compact(''));
        }
    }

    public function save_goods(Request $request)
    {
        $data = $request->except(['_token']);

        if ($request->isMethod('post')) {
        } else {
            $title = '填写商品详情';
            $fixed_title = '发布商品 - '.$title;
            $cat_id = isset($data['cat_id']) ? intval($data['cat_id']) : 0;
            $goods_mode = isset($data['goods_mode']) ? intval($data['goods_mode']) : 0; // 商品类别 0实物商品（物流发货） 1电子卡券（无需物流） 2服务商品（无需物流）

            $shop_id = seller_shop_info()->shop_id;
            $action_span = [];

            $explain_panel = [];
            $blocks = [
                'fixed_title' => $fixed_title,
                'explain_panel' => $explain_panel,
                'action_span' => $action_span
            ];
            $this->setLayoutBlock($blocks); // 设置block

            // 获取数据
            // model
            $model = [
                'mobile_price' => 0,
                'cost_price' => 0,
                'market_price' => 0,
                'invoice_type' => 0,
                'is_repair' => 0,
                'user_discount' => 0,
                'stock_mode' => 0,
                'top_layout_id' => 0,
                'bottom_layout_id' => 0,
                'warn_number' => 0,
                'goods_number' => 0,
                'goods_sort' => 255,
                'freight_id' => 0,
                'pricing_mode' => 0,
                'sales_model' => 0,
                'goods_status' => 1,
                'shop_id' => $shop_id,
                'cat_id' => $cat_id,
                'mobile_desc' => null,
                'other_attrs' => null,
            ];

            if (!empty($cat_id)) {
                // 获取分类名称 cat_names 如：个护化妆 > 美发护发 > 护发
                $cat_arr = $this->category->getCategoryBread($cat_id);
                $cat_names = '';
                $label_catNames = [];
                foreach ($cat_arr as $k=>$v) {
                    $label_catNames[$k] = $v->cat_name;
                    $cat_names .= $v->cat_name.' &gt; ';
                }
                $cat_names = rtrim($cat_names, ' &gt; ');

                // 属性列表 attr_list
                $attr_list = $this->attribute->getAttrList($cat_id);

                // 规格列表 spec_list
                $spec_list = $this->attribute->getSpecList($cat_id, $shop_id);

                // 分类列表
//        $cat_list = $this->category->getFormatCategory();
                $cat_list = '';

                $other_cat_ids = null;

                // 属性值列表
                $attr_values = $this->attrValue->getAttrValueList($cat_id);

                // app 属性列表
                $app_attrs_data = $this->attribute->getAppAttrsData($cat_id);

                // 关联品牌
                $brands = Category::where('cat_id', $cat_id)->select(['brand_ids'])->first();
                $brands->brand_ids = explode(',', rtrim($brands->brand_ids, ','));

                $brand_list = [
                    [
                        'brand_id' => 0,
                        'brand_name' => '-- 请选择品牌 --'
                    ],
                    [
                        'brand_id' => -1,
                        'brand_name' => '自定义品牌'
                    ]
                ];
                if (!empty($brands)) {
                    foreach ($brands->brand_ids as $item) {
                        $brand_name = Brand::where('brand_id', $item)->value('brand_name');
                        $brand_list[] = [
                            'brand_id' => $item,
                            'brand_name' => $brand_name
                        ];
                    }
                }

                // 商品规格值列表 新增为null
                $attr_ids_arr = array_column($spec_list, 'attr_id');
                $spec_values = [];
                if (!empty($attr_ids_arr)) {
                    foreach ($attr_ids_arr as $attr_id) {
                        $spec_values[$attr_id] = null;
                    }
                }
            } else {
                $cat_names = '';
                $attr_list = [];
                $spec_list = [];
                $cat_list = '';
                $other_cat_ids = null;
                $attr_values = [];
                $app_attrs_data = [];
                $brand_list = [];
                $spec_values = [];
                // 规格列表 spec_list
                $spec_list = $this->attribute->getSpecList($cat_id, $shop_id);
                // 商品规格值列表 新增为null
                $attr_ids_arr = array_column($spec_list, 'attr_id');
                $spec_values = [];
                if (!empty($attr_ids_arr)) {
                    foreach ($attr_ids_arr as $attr_id) {
                        $spec_values[$attr_id] = null;
                    }
                }
            }

            // 商品主图
//        $goods_image = get_image_url(sysconf('default_goods_image'));
            $goods_image = '';

            // 最近15天日期数组
            $date_list = [];
            for ($i = 0; $i <= 15; $i++) {
                $date_list[date("Y-m-d", strtotime("-".$i." day"))] = date("Y年m月d", strtotime("-".$i." day"));
            }
            $hour_list = range(0, 23);

            $minute_list = [];
            foreach (range(0, 59, 5) as $item) {
                $minute_list[$item] = $item;
            }

            // 详情版式
            $top_layouts = $this->goodsLayout->goodsLayoutByPosition(0); // 顶部模板
            $bottom_layouts = $this->goodsLayout->goodsLayoutByPosition(1); // 底部模板
            $packing_layouts = $this->goodsLayout->goodsLayoutByPosition(2); // 包装清单版式
            $service_layouts = $this->goodsLayout->goodsLayoutByPosition(3); // 售后保证版式

            // 运费模板列表
            $freight_list = Freight::where('shop_id', $shop_id)
                ->orderBy('freight_id', 'desc')
                ->select(['freight_id','title'])
                ->get()->toArray();

            // 店铺内分类列表
            $shop_cat_list = $this->shopCategory->getShopCategoryList($shop_id);

            // 服务保障
            $contract_list = $this->shopContract->getShopContract($shop_id);

            #=== 2024-01-09 START ===
            //销售分类
            $sale_cate = Db::table('category')->where(['type_id'=>1,'parent_id'=>0])->get();
            $sale_cate = $this->common->objectToArrays($sale_cate);
            //物流分类
            $logi_cate = Db::table('category')->where(['type_id'=>2,'parent_id'=>0])->get();
            $logi_cate = $this->common->objectToArrays($logi_cate);

            //出口国家
            //获取7大洲下的国家地区
            $state7 = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['pid'=>9])->get();
            $state7 = $this->common->objectToArrays($state7);
            $all_country = [];
            foreach ($state7 as $k=>$v) {
                $all_country[$k]['name'] = $v['param1'];
                $all_country[$k]['value'] = 'p'.$v['id'];
                $all_country[$k]['children'] = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['state_id'=>$v['id']])->get();
                $all_country[$k]['children'] = $this->common->objectToArrays($all_country[$k]['children']);
                foreach ($all_country[$k]['children'] as $k2=>$v2) {
                    $all_country[$k]['children'][$k2]['name'] = $v2['param2'];
                    $all_country[$k]['children'][$k2]['value'] = $v2['id'];
                    $all_country[$k]['children'][$k2]['children'] = '';
                }
            }
            $all_country = json_encode($all_country, true);

            //商品属性
            $goods_value = Db::table('ssl_value')->where(['pid'=>0])->get();
            $goods_value = $this->common->objectToArrays($goods_value);

            //计量单位
            $unit = Db::connection('shop_db')->table('unit')->get();
            $unit = $this->common->objectToArrays($unit);

            //币种
            $currency = Db::connection('shop_db')->table('centralize_currency')->get();
            $currency = $this->common->objectToArrays($currency);

            //活动
            $activity = Db::table('ssl_activity')->get();
            $activity = $this->common->objectToArrays($activity);
            $activity = json_encode($activity, true);

            //减免规则
            $reduction_rule = Db::table('ssl_reduction_rule')->get();
            $reduction_rule = $this->common->objectToArrays($reduction_rule);
            foreach ($reduction_rule as $k=>$v) {
                $reduction_rule[$k]['content'] = json_decode($v['content'], true);
            }

            //适合人群
            $shihe = [];
            $shihe['renqun'] = Db::table('ssl_value')->where(['pid'=>16])->get();
            $shihe['renqun'] = $this->common->objectToArrays($shihe['renqun']);
            //适用国家
            $shihe['country'] = json_decode($all_country, true);
            //适用网媒
            $shihe['media'] = Db::table('ssl_value')->where(['pid'=>25])->get();
            $shihe['media'] = $this->common->objectToArrays($shihe['media']);
            //适用节日
            $shihe['festival'] = Db::table('ssl_value')->where(['pid'=>19])->get();
            $shihe['festival'] = $this->common->objectToArrays($shihe['festival']);
            //适用同款
            $shihe['common_goods'] = Db::table('goods')->where(['shop_id'=>seller_shop_info()->shop_id])->get();
            $shihe['common_goods'] = $this->common->objectToArrays($shihe['common_goods']);
            //适用宗教
            $shihe['zongjiao'] = Db::table('ssl_value')->where(['pid'=>22])->get();
            $shihe['zongjiao'] = $this->common->objectToArrays($shihe['zongjiao']);
            $shihe['renqun'] = json_encode($shihe['renqun'], true);
            $shihe['country'] = json_encode($shihe['country'], true);
            $shihe['media'] = json_encode($shihe['media'], true);
            $shihe['festival'] = json_encode($shihe['festival'], true);
            $shihe['common_goods'] = json_encode($shihe['common_goods'], true);
            $shihe['zongjiao'] = json_encode($shihe['zongjiao'], true);

            #=== 2024-01-09 END ===

            // 获取商品单位
            $goods_unit_list = [];
            $goods_unit_list[""] = '--请选择--';
            $units = GoodsUnit::where('shop_id', $shop_id)->orderBy('unit_id', 'asc')->get();
            if (!empty($units)) {
                foreach ($units as $item) {
                    $goods_unit_list[$item->unit_id] = $item->unit_name;
                }
            }

            $edit_items = explode(',', shopconf('goods_edit_items', false, $shop_id));

            $shop_freight_fee = !empty(shopconf('freight_fee', false, $shop_id)) ? shopconf('freight_fee', false, $shop_id) : '0.00'; // 店铺统一运费

            $is_supply = seller_shop_info()->is_supply;

            $wholesale_enable = 0; // 批发状态 用途不明

            $edit_enable = 1;

            $app_extra_data = [];
            $app_prefix_data = [
                'model' => $model,
                'cat_names' => $cat_names,
                'attr_list' => $attr_list,
                'spec_list' => $spec_list,
                'cat_list' => $cat_list,
                'other_cat_ids' => $other_cat_ids,
                'attr_values' => $attr_values,
                'app_attrs_data' => $app_attrs_data,
                'spec_values' => $spec_values,
                'goods_image' => $goods_image,
                'date_list' => $date_list,
                'hour_list' => $hour_list,
                'minute_list' => $minute_list,
                'cat_id' => null,
                'top_layouts' => $top_layouts,
                'bottom_layouts' => $bottom_layouts,
                'packing_layouts' => $packing_layouts,
                'service_layouts' => $service_layouts,
                'freight_list' => $freight_list,
                'shop_cat_list' => $shop_cat_list,
                'contract_list' => $contract_list,
                'brand_list' => $brand_list,
                'goods_unit_list' => $goods_unit_list,
                'edit_items' => $edit_items,
                'shop_freight_fee' => $shop_freight_fee,
                'is_supply' => $is_supply,
                'wholesale_enable' => $wholesale_enable,
                'edit_enable' => $edit_enable
            ];
            $app_context_data = '';
            $app_suffix_data = [];
            $web_data = [];

            $compact = compact(
                'goods_mode',
                'cat_names',
                'attr_list',
                'spec_list',
                'cat_list',
                'other_cat_ids',
                'attr_values',
                'spec_values',
                'goods_image',
                'date_list',
                'hour_list',
                'minute_list',
                'cat_id',
                'top_layouts',
                'bottom_layouts',
                'packing_layouts',
                'service_layouts',
                'freight_list',
                'shop_cat_list',
                'contract_list',
                'brand_list',
                'goods_unit_list',
                'edit_items',
                'shop_freight_fee',
                'is_supply',
                'wholesale_enable',
                'edit_enable',
                'all_country',
                'goods_value',
                'unit',
                'currency',
                'activity',
                'shihe',
                'label_catNames',
                'reduction_rule',
                'sale_cate',
                'logi_cate',
                'app_extra_data',
                'app_prefix_data',
                'app_context_data',
                'app_suffix_data',
                'web_data'
            );

            return view('func.goods.save_goods', $compact);
        }
    }

    public function add_images(Request $request)
    {
        $dat = $request->except(['_token']);
        $title = '上传商品图片';
        $fixed_title = '发布商品 - '.$title;
        $goods_id = $request->get('id', 0);
        if (!$goods_id) {
            return redirect('/func/goods/goods_manage');
        }

        $action_span = [];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'explain_panel' => $explain_panel,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block


        // 获取数据
        $goods_images = $this->goodsImage->getGoodsImages($goods_id);

        $first_attr_id = GoodsSpec::where([['goods_id',$goods_id],['is_checked',1]])->select(['attr_id'])->orderBy('spec_sort', 'asc')->value('attr_id');
        $spec_name = Attribute::where('attr_id', $first_attr_id)->value('attr_name');
        if (empty($spec_name)) {
            $spec_name = '规格';
        }

        $spec_list = GoodsSpec::where([['goods_id',$goods_id],['is_checked',1],['attr_id',$first_attr_id]])
            ->select(['spec_id','goods_id','attr_id','attr_vid','cat_id','attr_value','attr_desc','is_checked','spec_sort'])
            ->orderBy('spec_sort', 'asc')->get()->toArray();
        if (empty($spec_list)) { // 无规格
            $spec_list = [
                [
                    'spec_id' => 'default',
                    'attr_value' => '无'
                ]
            ];
        }

        // model
        $model = $this->goods->getGoodsModelInfo($goods_id);

        $default_image = get_image_url(sysconf('default_goods_image'));

        $is_publish = 1;

        $app_extra_data = [];
        $app_prefix_data = [
            'goods_images' => $goods_images,
            'spec_name' => $spec_name,
            'spec_list' => $spec_list,
            'model' => $model,
            'default_image' => $default_image,
            'is_publish' => $is_publish
        ];
        $webData = []; // web端（pc、mobile）数据对象
        // $app_context_data = $this->getAppContext();
        $app_context_data = [];
        $app_suffix_data = [];

        $compact = compact('goods_images', 'spec_name', 'spec_list', 'model', 'default_image', 'is_publish', 'webData', 'app_context_data', 'app_suffix_data');

        return view('func.goods.add_images', $compact);
    }

    public function success(Request $request)
    {
        $dat = $request->except(['_token']);
        $title = '成功';
        $fixed_title = '发布商品 - '.$title;
        $goods_id = $request->get('id');

        $this->sublink($this->edit_links, 'success', '', '?id='.$goods_id);
        $action_span = [
            [
                'url' => '/goods/list/index',
                'icon' => 'fa-reply',
                'text' => '返回商品列表'
            ],
            [
                'id' => 'btn_view',
                'url' => '',
                'icon' => 'fa-th-large',
                'text' => '查看商品'
            ],
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'explain_panel' => $explain_panel,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 获取数据
        $is_publish = 0;
        $app_extra_data = [];
        $app_prefix_data = [
            'is_publish' => $is_publish,
            'goods_id' => $goods_id,
        ];
        // $app_context_data = $this->getAppContext();
        $app_context_data = [];
        $app_suffix_data = [];
        $webData = []; // web端（pc、mobile）数据对象
        $compact = compact('is_publish', 'goods_id', 'app_extra_data', 'app_prefix_data', 'app_context_data', 'app_suffix_data', 'webData');

        return view('func.goods.success', $compact);
    }

    public function del_goods(Request $request)
    {
        $data = $request->except(['_token']);
        $goods_id = isset($data['id']) ? intval($data['id']) : 0;
        $type = isset($data['typ']) ? intval($data['typ']) : 0;

        if ($type==1) {
            #删除
            $res = Db::table('goods')->where(['goods_id'=>$goods_id])->update([
                'goods_status'=>-2
            ]);
        } elseif ($type==-1) {
            #下架
            $res = Db::table('goods')->where(['goods_id'=>$goods_id])->update([
                'goods_status'=>-1
            ]);
        } elseif ($type==0) {
            #提交上架审核
            $res = Db::table('goods')->where(['goods_id'=>$goods_id])->update([
                'goods_status'=>0
            ]);
        }

        if ($res) {
            return response()->json(['code'=>0,'msg'=>'操作成功']);
        }
    }

    public function shelf_manage(Request $request)
    {
        $data = $request->except(['_token']);

        if (isset($data['pa'])) {
            $limit = $request->get('limit');
            $page = $request->get('page') - 1;
            if ($page != 0) {
                $page = $limit * $page;
            }
            $keyword = $request->get('keywords') ? $request->get('keywords') : '';

            $manage = $this->get_merchant();

            $where = [];
            $where[] = ['shop_id', session('shop_info')->shop_id];
            $where[] = ['is_delete', 0]; // 查询删除状态为0的商品
            $where[] = ['goods_status', -1]; // 查询删除状态为0的商品

            $count = Db::table('goods')->where($where)->count();
            $rows = DB::table('goods')->where($where)
                ->offset($page)
                ->limit($limit)
                ->orderBy('goods_id', 'desc')
                ->get()
                ->toArray();

            $rows = objtoarr($rows);

            $_status = ['-1'=>'已下架','0'=>'待审核','1'=>'已上架'];
            foreach ($rows as &$item) {
                $item['status_name'] = $_status[$item['goods_status']];
            }

            return response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
        } else {
            return view('func.goods.shelf_manage', compact(''));
        }
    }
}
