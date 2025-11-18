<?php

// +----------------------------------------------------------------------
// | laravelvip 乐融沃B2B2C商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
// +----------------------------------------------------------------------
// | Notice: This code is not open source, it is strictly prohibited
// |         to distribute the copy, otherwise it will pursue its
// |         legal responsibility.
// +----------------------------------------------------------------------
// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
// | 网站地址: http://www.laravelvip.com
// +----------------------------------------------------------------------
// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
// | 如需使用，请移步官网购买正版授权。
// +----------------------------------------------------------------------
// | Author: 雲溪荏苒 <290648237@qq.com>
// | Date:2018-07-28
// | Description: 商家后台 商品发布
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Goods;

use App\Functions\Common;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Category;
use App\Models\Freight;
use App\Models\GoodsCat;
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

class PublishController extends Seller
{
    private $edit_links = [
        ['url' => 'goods/publish/edit', 'text' => '编辑商品'],
        ['url' => 'goods/publish/edit-images', 'text' => '编辑图片'],
        ['url' => 'goods/publish/edit-gift', 'text' => '赠送赠品'],
        ['url' => 'goods/publish/success', 'text' => '发布成功'],
    ];

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

    /**
     * 第一步 - 选择商品分类
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        $title = '选择商品分类';

        $fixed_title = '发布商品 - '.$title;
        $id = $request->get('id', 0); // 编辑商品重新选择分类时，会带上商品id参数

        $action_span = [];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $condition = [
            'where' => [['parent_id', 0]],
            'sortname' => 'cat_id',
            'sortorder' => 'asc',
            'page_size' => 99999
        ];
        list($cat_list, $total)= $this->category->getList($condition);

        $compact = compact('title', 'cat_list', 'id');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [
                'cat_list' => $cat_list,
                'id' => $id // 商品id
            ],
            'app_prefix_data' => [],
            'app_context_data' => [],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'goods.publish.add'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }


    /**
     * 第二步 - 填写商品详情 - 新增
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $title = '填写商品详情';
        $fixed_title = '发布商品 - '.$title;
        $cat_id = $request->get('cat_id');
        $goods_mode = $request->get('goods_mode', 0); // 商品类别 0实物商品（物流发货） 1电子卡券（无需物流） 2服务商品（无需物流）

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
            'logi_cate'
        );

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
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
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'goods.publish.index'
        ];

        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    #=== 2024-01-09 自定義方法 START ===
    public function checkvalue(Request $request)
    {
        $dat = $request->except(['_token']);
        if ($dat['type']==1) {
            #检查属性名称是否已有
            $ishave = Db::table('ssl_value')->where(['name'=>trim($dat['val']),'pid'=>0])->first();

            if (!empty($ishave)) {
                return response()->json(['code'=>-1,'msg'=>'已存在该属性名称']);
            } else {
                return response()->json(['code'=>0,'msg'=>'可以添加该属性名称']);
            }
        } elseif ($dat['type']==2) {
            #获取该属性下的所有描述
            $list = Db::table('ssl_value')->where(['pid'=>trim($dat['val'])])->get();
            $list = $this->common->objectToArrays($list);
            return response()->json(['code'=>0,'list'=>$list]);
        } elseif ($dat['type']==3) {
            #检查属性描述是否已有
            $ishave = Db::table('ssl_value')->where(['name'=>trim($dat['val']),'pid'=>intval($dat['pid'])])->first();

            if (!empty($ishave)) {
                return response()->json(['code'=>-1,'msg'=>'已存在该属性描述']);
            } else {
                return response()->json(['code'=>0,'msg'=>'可以添加该属性描述']);
            }
        }
    }

    public function get_area(Request $request)
    {
        $dat = $request->except(['_token']);
        $list = [];
        if ($dat['type']==1) {
            #获取国家下的一级区域
            $list = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['country_id'=>$dat['val'],'pid'=>0])->get();
        } elseif ($dat['type']==2) {
            #获取国家下的二级区域
            $list = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['pid'=>$dat['val']])->get();
        }
        return response()->json(['code'=>0,'msg'=>'获取成功','data'=>$list]);
    }

    public function get_nextcate(Request $request)
    {
        $dat = $request->except(['_token']);
        $list = Db::table('category')->where(['parent_id'=>$dat['parent_id']])->get();
        $list = $this->common->objectToArrays($list);

        #获取该类别的属性
        $value = Db::table('ssl_value')->where(['cate_id'=>$dat['parent_id'],'pid'=>0])->get();
        $value = $this->common->objectToArrays($value);

        #该类别下的品牌
        $brands = Category::where('cat_id', $dat['parent_id'])->select(['brand_ids'])->first();
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
        if (!empty($brands->brand_ids)) {
            $brands->brand_ids = explode(',', rtrim($brands->brand_ids, ','));
            foreach ($brands->brand_ids as $item) {
                $brand_name = Brand::where('brand_id', $item)->value('brand_name');
                $brand_list[] = [
                    'brand_id' => $item,
                    'brand_name' => $brand_name
                ];
            }
        }

        return response()->json(['code'=>0,'data'=>$list,'value'=>$value,'brand'=>$brand_list]);
    }
    #=== 2024-01-09 自定義方法 END ===

    /**
     * 刷新运费模板
     *
     * @param bool $isJson 是否返回json结果 默认是
     * @return array
     */
    public function freights($isJson = true)
    {
        $condition = [
            'where' => [['shop_id', seller_shop_info()->shop_id]],
            'sortname' => 'freight_id',
            'sortorder' => 'desc',
        ];
        list($list, $ftotal) = $this->freight->getList($condition);

        if (!$isJson) { // 返回数组结果
            return $list;
        }
        $extra = [
            'shop_freight_fee' => "0",
            'shop_freight_fee_format' => "￥0"
        ];
        return result(0, $list, '', $extra);
    }

    /**
     * 新增商品第二步 保存商品信息
     *
     * @param Request $request
     * @return mixed
     */
    public function saveData(Request $request)
    {
        // GoodsModel
        // radio-date
        // goods_attrs array
        // spec_alias array
        // other_spec array
        // specs array
        // market_price
        // goods_price
        // goods_number
        // warn_number
        // goods_sn
        // goods_barcode
        // goods_stockcode
        // shop_cat_ids array
        // goods_specs array
        // sku_list array
        // other_cat_ids array
        // other_attrs array
        $shop_id = seller_shop_info()->shop_id;
        $goods_id = $request->get('id', 0); // 商品id 如果为0 则是新增商品 否则是编辑商品
        $postData = json_decode($request->post('data'), true);
//        $GoodsModel = $postData['GoodsModel'];

//        dd($postData);
        if ($goods_id) {
            // 编辑商品
            $ret = $this->goods->modifyGoods($postData, $goods_id);
        } else {
            $ret = $this->goods->addGoods($postData, $shop_id);
        }
//        dd($ret);
        if ($ret === false) {
            return result(-1, '', '保存失败');
        }

        return result(0, $ret->goods_id, '保存成功');
    }

    /**
     * 获取详情版式列表
     *
     * @param Request $request
     * @return array
     */
    public function layouts(Request $request)
    {
        $data = $this->goodsLayout->getGoodsLayouts(seller_shop_info()->shop_id);
        return result(0, $data);
    }

    /**
     * 添加商品图片
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function addImages(Request $request)
    {
        $title = '上传商品图片';
        $fixed_title = '发布商品 - '.$title;
        $goods_id = $request->get('id', 0);
        if (!$goods_id) {
            return redirect('/goods/list/index');
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

        $compact = compact('goods_images', 'spec_name', 'spec_list', 'model', 'default_image', 'is_publish');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'goods_images' => $goods_images,
                'spec_name' => $spec_name,
                'spec_list' => $spec_list,
                'model' => $model,
                'default_image' => $default_image,
                'is_publish' => $is_publish
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'goods.publish.add_images'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 编辑商品图片
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function editImages(Request $request)
    {
        $title = '编辑';
        $fixed_title = '商品管理 - '.$title;
        $goods_id = $request->get('id', 0);
        if (!$goods_id) {
            return redirect('/goods/list/index');
        }
        $extra = '?id='.$goods_id;
        $this->sublink($this->edit_links, 'edit-images', '', $extra, 'success');

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

        $is_publish = 0;

        $compact = compact('goods_images', 'spec_name', 'spec_list', 'model', 'default_image', 'is_publish');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'goods_images' => $goods_images,
                'spec_name' => $spec_name,
                'spec_list' => $spec_list,
                'model' => $model,
                'default_image' => $default_image,
                'is_publish' => $is_publish
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'goods.publish.add_images'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 保存商品图片
     *
     * @param Request $request
     * @return mixed
     */
    public function saveImageData(Request $request)
    {
        $goods_id = $request->get('id');
        $goodsImages = $request->post('goods_images');

        $ret = $this->goodsImage->addGoodsImage($goodsImages, $goods_id);

        if ($ret === false) {
            return result(-1, '', '操作失败！');
        }
        return result(0, '', '操作成功！');
    }

    /**
     * 编辑赠送赠品
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editGift(Request $request)
    {
        $title = '赠送赠品';
        $fixed_title = '商品管理 - '.$title;

        $goods_id = $request->get('id');
        $extra = '?id='.$goods_id;
        $this->sublink($this->edit_links, 'edit-gift', '', $extra, 'success');

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

        if ($request->method() == 'POST') {

            // success
            return result(0, '', '操作成功');
        }


        // 获取数据 todo
        $sku_list = [];
        $gift_list = [];

        $compact = compact('sku_list', 'goods_id', 'gift_list');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'sku_list' => $sku_list,
                'goods_id' => $goods_id,
                'gift_list' => $gift_list,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'goods.publish.edit_gift'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 发布成功
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function success(Request $request)
    {
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

        $compact = compact('is_publish', 'goods_id');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'is_publish' => $is_publish,
                'goods_id' => $goods_id,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'goods.publish.success'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 编辑商品基本信息
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $title = '编辑';
        $fixed_title = '商品管理 - '.$title;

        $goods_id = $request->get('id');
        $cat_id = $request->get('cat_id', 0);  // 重新选择商品分类后的商品分类id

        $extra = '?id='.$goods_id;
        $this->sublink($this->edit_links, 'edit', '', $extra, 'success');
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

        $shop_id = seller_shop_info()->shop_id;

        // 获取数据
        // model
        $model = $this->goods->getGoodsModelInfo($goods_id);
        //+=自定义参数解析 START
        $model['crossborder_cate'] = json_decode($model['crossborder_cate'], true);
        $model['nospecs'] = json_decode($model['nospecs'], true);
//        dd($model['nospecs']);
        $model['crossborder_restrict'] = json_decode($model['crossborder_restrict'], true);
        $model['platform_intro'] = json_decode($model['platform_intro'], true);
        $model['platform_introNum'] = 1;
        if (!empty($model['platform_intro'])) {
            $num = 0;
            foreach ($model['platform_intro'] as $k=>$v) {
                $big_parag_num2 = explode('.', $v['parag_num']);
                if (count($big_parag_num2)==2) {
                    $num+=1;
                }
            }
            $model['platform_introNum'] = $num;
        }
        $model['userprice_intro'] = json_decode($model['userprice_intro'], true);
        $model['userprice_introNum'] = 1;
        if (!empty($model['userprice_intro'])) {
            $num = 0;
            foreach ($model['userprice_intro'] as $k=>$v) {
                $big_parag_num2 = explode('.', $v['parag_num']);
                if (count($big_parag_num2)==2) {
                    $num+=1;
                }
            }
            $model['userprice_introNum'] = $num;
        }
        $model['platform_preferent'] = json_decode($model['platform_preferent'], true);
        $model['merchant_valueadd'] = json_decode($model['merchant_valueadd'], true);
        $model['activity_info'] = json_decode($model['activity_info'], true);
        $model['promotion_text'] = json_decode($model['promotion_text'], true);
//        dd($model);
        //+=自定义参数解析 END

        if (!$cat_id) {
            $cat_id = $model['cat_id'];
        }

        // 获取分类名称 cat_names 如：个护化妆 > 美发护发 > 护发
        $cat_arr = $this->category->getCategoryBread($cat_id);

        $cat_names = '';
        foreach ($cat_arr as $v) {
            $cat_names .= $v->cat_name.' &gt; ';
        }
        $cat_names = rtrim($cat_names, ' &gt; ');

        // 属性列表 attr_list
        $attr_list = $this->attribute->getAttrList($cat_id);

        // 规格列表 spec_list
        $spec_list = $this->attribute->getSpecList($cat_id, $shop_id);

        #重新排序规格
        if ($model['have_specs']==1) {
            #有规格
            $sku = Db::table('goods_sku')->where(['sku_id'=>$model['sku_id']])->first();
            $spec_ids = explode('|', $sku->spec_ids);
            $new_specList = [];
            $remain_ids = '';#剩下的ids
            foreach ($spec_ids as $k2=>$v2) {#12,13,14
                foreach ($spec_list as $k=>$v) {#所有规格，12-18
                    if ($v2==$v['attr_id']) {
                        array_push($new_specList, $v);
                        if (!empty($remain_ids)) {
                            $remain_ids = str_replace($v2, '', $remain_ids);
                        }
                    } else {
                        if ($k2==0) {
                            $remain_ids.=$v['attr_id'].',';
                        }
                    }
                }
            }
            $remain_ids = explode(',', rtrim($remain_ids, ','));
            foreach ($remain_ids as $k2=>$v2) {
                if (!empty($v)) {
                    foreach ($spec_list as $k=>$v) {
                        if ($v2==$v['attr_id']) {
                            array_push($new_specList, $v);
                        }
                    }
                }
            }
            $spec_list = $new_specList;
        }
//        dd($spec_list);

        // 分类列表
//        $cat_list = $this->category->getFormatCategory();
        $cat_list = '';

        // 扩展分类列表
        $other_cat_ids = [];
        $goods_cat = [];
//        $goods_cat = GoodsCat::where('goods_id', $goods_id)->select(['cat_id'])->get()->toArray();
//        if (!empty($goods_cat)) {
//            foreach ($goods_cat as $v) {
//                $other_cat_ids[] = [
//                    'cat_id' => $v['cat_id'],
//                    'cat_name' => Category::where('cat_id', $v['cat_id'])->value('cat_name')
//                ];
//            }
//        }

        // 属性值列表
        $attr_values = $this->attrValue->getAttrValueList($cat_id);

        // app 属性列表
        $app_attrs_data = $this->attribute->getAppAttrsData($cat_id);

        // 商品规格值列表 新增为null
        $attr_ids_arr = array_column($spec_list, 'attr_id');
        $spec_values = [];
        if (!empty($attr_ids_arr)) {
            foreach ($attr_ids_arr as $attr_id) {
                $spec_values[$attr_id] = null;
            }
        }

        // 商品属性
        $goods_attrs = $this->goodsAttr->getGoodsAttrs($goods_id);

        // app 商品属性列表
        $app_goods_attrs = $this->goodsAttr->getAppGoodsAttrs($goods_id);

        // 商品规格
        $goods_specs = $this->goodsSpec->getGoodsSpecs($goods_id);

        // 选中商品规格
        $goods_checked_specs = array_collapse(array_values($goods_specs));
        // 商品规格描述
        $goods_specs_desc = $this->goodsSpec->getGoodsSpecsDesc($goods_id);

        // 商品扩展规格 todo 暂时不知道数据来源
        $goods_other_specs = null;

        // 商品规格别名
        $spec_alias = $this->specAlias->getSpecAlias($goods_id);

        // 商品SKU列表
        $goods_sku_list = $this->goodsSku->getSellerSkuList($goods_id);
//        dd($goods_sku_list);
        // 商品主图
        $goods_image = get_image_url(sysconf('default_goods_image'));

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

        // 关联品牌
//        $brands = BrandCategory::where('cat_id', $cat_id)->select(['brand_id'])->get();
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

        $back_url = null; // todo
        $third_goods_url = null;
        $third_id = null;
        $scid = $request->get('sc_id', 0);
        $step_price = null; // todo
        $cat_edit = 1; // 是否允许编辑分类

        $goods_info = $model;
        #=== 2024-01-09 START ===
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
//        dd($goods_info);

        //属性下的子属性
        if (isset($goods_info['other_attrs']['value_name'.$goods_info['cat_id']])) {
            foreach ($goods_info['other_attrs']['value_name'.$goods_info['cat_id']] as $k=>$v) {
                $goods_info['other_attrs']['child_value'][$k] = Db::table('ssl_value')->where(['pid'=>$v])->get();
                $goods_info['other_attrs']['child_value'][$k] = $this->common->objectToArrays($goods_info['other_attrs']['child_value'][$k]);
                #对应属性描述
                $goods_info['other_attrs']['value_desc'.$v] = Db::table('ssl_value')->where(['pid'=>$v])->get();
                $goods_info['other_attrs']['value_desc'.$v] = $this->common->objectToArrays($goods_info['other_attrs']['value_desc'.$v]);
            }
        }
        $crossb_cate = 0;
        if (!empty($goods_info['crossb_cate3'])) {
            $crossb_cate = $goods_info['crossb_cate3'];
        } elseif (!empty($goods_info['crossb_cate2'])) {
            $crossb_cate = $goods_info['crossb_cate2'];
        } elseif (!empty($goods_info['crossb_cate1'])) {
            $crossb_cate = $goods_info['crossb_cate1'];
        }
        if (isset($goods_info['other_attrs']['value_name'.$crossb_cate])) {
            foreach ($goods_info['other_attrs']['value_name'.$crossb_cate] as $k=>$v) {
                $goods_info['other_attrs']['child_value'][$k] = Db::table('ssl_value')->where(['pid'=>$v])->get();
                $goods_info['other_attrs']['child_value'][$k] = $this->common->objectToArrays($goods_info['other_attrs']['child_value'][$k]);
                #对应属性描述
                $goods_info['other_attrs']['value_desc'.$v] = Db::table('ssl_value')->where(['pid'=>$v])->get();
                $goods_info['other_attrs']['value_desc'.$v] = $this->common->objectToArrays($goods_info['other_attrs']['value_desc'.$v]);
            }
        }

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

        //销售分类
        $sale_cate = Db::table('category')->where(['type_id'=>1,'parent_id'=>0])->get();
        $sale_cate = $this->common->objectToArrays($sale_cate);

        //销售分类的全部选择
        $all_cat_id2 = [];
        $sale_value_selected = [];
        if (!empty($goods_info['cat_id2'])) {
            $cat_id2 = Db::table('category')->where(['cat_id'=>$goods_info['cat_id2']])->first();
            $all_cat_id2 = Db::table('category')->where(['parent_id'=>$cat_id2->parent_id])->get();
            $all_cat_id2 = $this->common->objectToArrays($all_cat_id2);

            #获取该销售类别的属性
            $sale_value_selected = Db::table('ssl_value')->where(['cate_id'=>$cat_id2->cat_id,'pid'=>0])->get();
            $sale_value_selected = $this->common->objectToArrays($sale_value_selected);
        } else {
            #获取该销售类别的属性
            $sale_value_selected = Db::table('ssl_value')->where(['cate_id'=>$goods_info['cat_id1'],'pid'=>0])->get();
            $sale_value_selected = $this->common->objectToArrays($sale_value_selected);
        }

        //物流分类
        $logi_cate = Db::table('category')->where(['type_id'=>2,'parent_id'=>0])->get();
        $logi_cate = $this->common->objectToArrays($logi_cate);

        //物流分类二级
        $logi_cate2 = [];
        $crossb_cate = 0;
        $logi_value_selected = [];
        if (!empty($goods_info['crossb_cate2'])) {
            $crossb_cate = $goods_info['crossb_cate2'];
            $logi_cate2 = Db::table('category')->where(['parent_id'=>$goods_info['crossb_cate1']])->get();
            $logi_cate2 = $this->common->objectToArrays($logi_cate2);

            #获取该物流类别的属性
            $logi_value_selected = Db::table('ssl_value')->where(['cate_id'=>$crossb_cate,'pid'=>0])->get();
            $logi_value_selected = $this->common->objectToArrays($logi_value_selected);
        } else {
            $crossb_cate = $goods_info['crossb_cate1'];
            #获取该物流类别的属性
            $logi_value_selected = Db::table('ssl_value')->where(['cate_id'=>$crossb_cate,'pid'=>0])->get();
            $logi_value_selected = $this->common->objectToArrays($logi_value_selected);
        }
//        dd($goods_info);
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


        $compact = compact(
            'title',
            'goods_info',
            'cat_names',
            'attr_list',
            'spec_list',
            'cat_list',
            'other_cat_ids',
            'attr_values',
            'spec_values',
            'goods_attrs',
            'goods_specs',
            'goods_checked_specs',
            'goods_specs_desc',
            'goods_other_specs',
            'spec_alias',
            'goods_sku_list',
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
            'third_goods_url',
            'third_id',
            'scid',
            'step_price',
            'cat_edit',
            'all_country',
            'goods_value',
            'unit',
            'currency',
            'activity',
            'shihe',
            'reduction_rule',
            'sale_cate',
            'all_cat_id2',
            'sale_value_selected',
            'logi_cate',
            'logi_cate2',
            'crossb_cate',
            'logi_value_selected'
        );

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'model' => $model,
                'cat_names' => $cat_names,
                'attr_list' => $attr_list,
                'spec_list' => $spec_list,
                'cat_list' => $cat_list,
                'other_cat_ids' => $other_cat_ids,
                'attr_values' => $attr_values,
                'app_attrs_data' => $app_attrs_data,
                'spec_values' => $spec_values,
                'goods_attrs' => $goods_attrs,
                'app_goods_attrs' => $app_goods_attrs,
                'goods_specs' => $goods_specs,
                'goods_checked_specs' => $goods_checked_specs,
                'goods_specs_desc' => $goods_specs_desc,
                'goods_other_specs' => $goods_other_specs,
                'spec_alias' => $spec_alias,
                'goods_sku_list' => $goods_sku_list,
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
                'edit_enable' => $edit_enable,
                'back_url' => $back_url,
                'third_goods_url' => $third_goods_url,
                'third_id' => $third_id,
                'scid' => $scid,
                'step_price' => $step_price,
                'cat_edit' => $cat_edit
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'goods.publish.edit'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function addSpec(Request $request)
    {
        $shop_id = seller_shop_info()->shop_id;
        $uuid = make_uuid();

        if ($request->method() == 'POST') {
            $post = $request->post('data');
            $postData = json_decode($post, true);
            $attributeModel = $postData['Attribute'];
            $attr_values = $postData['attr_values'];
            $saveData = $attributeModel;
            $saveData['shop_id'] = $shop_id;

            $ret = $this->attribute->storeAttr($saveData, $attr_values);

            if ($ret === false) {
                // fail
                return result(-1, '', '操作失败');
            }
            $attr_id = $spec_id = $ret->attr_id;
            $spec_name = $ret->attr_name;
            $attrValueCondition = [
                'where' => [['attr_id', $attr_id]],
                'limit' => 0,
                'sortname' => 'attr_vsort',
                'sortorder' => 'asc'
            ];
            list($attr_values, $attr_value_total) = $this->attrValue->getList($attrValueCondition);

            $postRender = view('goods.publish.add_spec_post', compact('attr_id', 'spec_id', 'spec_name', 'attr_values'))->render();
            // success
            $extra = ['attr_id'=>$attr_id, 'attr_name'=>$ret->attr_name];
            return result(0, $postRender, '操作成功', $extra);
        }

        $render = view('goods.publish.add_spec', compact('uuid'))->render();
        return result(0, $render);
    }

    /**
     * 将商品(批量)移入回收站
     *
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->goods->softDeleteGoods(explode(',', $ids));
        if (is_int($ids)) {
            $msg = '商品删除';
        } else {
            $msg = '商品批量删除';
        }
        if ($ret === false) {
            // Log
//            shop_log($msg.'失败。ID：'.$ids);
            return result(-1, null, '删除失败');
        }

        // Log
        shop_log($msg.'成功。ID：'.$ids);
        return result(0, null, '删除成功');
    }

    /**
     * 商品(批量)还原
     *
     * @param Request $request
     * @return array
     */
    public function recover(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->goods->recoverGoods(explode(',', $ids));
        if (is_int($ids)) {
            $msg = '商品还原';
        } else {
            $msg = '商品批量还原';
        }
        if ($ret === false) {
            // Log
//            shop_log($msg.'失败。ID：'.$ids);
            return result(-1, null, '商品还原失败');
        }
        // Log
        shop_log($msg.'成功。ID：'.$ids);
        return result(0, null, '商品已还原！');
    }

    /**
     * 商品(批量)彻底删除
     *
     * @param Request $request
     * @return mixed
     */
    public function foreverDelete(Request $request)
    {
        $ids = $request->post('ids');
        if (is_int($ids)) {
            $msg = '商品彻底删除';
        } else {
            // 批量删除
            $msg = '商品批量彻底删除';
        }

        $ret = $this->goods->foreverDeleteGoods(0, explode(',', $ids));

        if ($ret === false) {
            // Log
//            shop_log($msg.'失败。ID：'.$ids);
            return result(-1, null, $msg.'失败');
        }

        // Log
        shop_log($msg.'成功。ID：'.$ids);
        return result(0, null, '商品已彻底删除！');
    }

    /**
     * 异步加载商品单位列表
     *
     * @param bool $isJson
     * @return array
     */
    public function reloadGoodsUnit($isJson = true)
    {
        $list = [0 => '--请选择--'];
        $unitList = GoodsUnit::where('shop_id', seller_shop_info()->shop_id)->orderBy('unit_id', 'asc')->get();
        if (!empty($unitList)) {
            foreach ($unitList as $item) {
                $list[$item->unit_id] = $item->unit_name;
            }
        }
        if (!$isJson) { // 返回数组结果
            return $list;
        }
        return result(0, $list);
    }

    public function catList(Request $request)
    {
        $parent_id = $request->get('id', 0); // 父id
        $condition = [
            'where' => [['parent_id', $parent_id]],
            'sortname' => 'cat_id',
            'sortorder' => 'asc',
            'page_size' => 99999
        ];
        list($cat_list, $total)= $this->category->getList($condition);

        $render = view('goods.publish.partials._cat_list', compact('cat_list'))->render();
        return $render;
    }

    /**
     * 搜索商品分类
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function catSearch(Request $request)
    {
        $cat_name = $request->get('cat_name', ''); // 搜索分类关键词

        list($cat_list, $total) = $this->_cat_search($cat_name);
        $render = view('goods.publish.cat_search', compact('cat_list', 'total'))->render();

        return result(0, $render);
    }

    /**
     * 根据分类名称关键词搜索结果
     *
     * @param string $cat_name 分类名称关键词
     * @return array
     */
    private function _cat_search($cat_name = '')
    {
        $cat_ids = Category::select(['cat_id'])->where([['cat_name', 'like', "%{$cat_name}%"]])->pluck('cat_id');
        $count = count($cat_ids);
        $cat_arr = [];
        if (!empty($cat_ids)) {
            foreach ($cat_ids as $cat_id) {
                // 根据分类id获取该分类及子分类
                $cat_obj = $this->category->getCategoryBread($cat_id);
                $cat_items = [];
                if (!empty($cat_obj)) {
                    foreach ($cat_obj as $item) {
                        $cat_items[] = [
                            'cat_id' => $item->cat_id,
                            'parent_id' => $item->parent_id,
                            'cat_level' => $item->cat_level,
                            'cat_name' => $item->cat_name,
                            'cat_name_pinyin_short' => pinyin_abbr($item->cat_name), // 拼音首字母简写
                            'cat_name_pinyin' => pinyin_permalink($item->cat_name, '') // 拼音全拼
                        ];
                    }
                }
                $cat_arr[] = $cat_items;
            }
        }

        return [$cat_arr, $count];
    }
}
