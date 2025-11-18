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
// | Date:2018-08-17
// | Description: 首页控制器
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers;

use App\Models\Shop;
use App\Modules\Base\Http\Controllers\Backend2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Nexmo\Response;

header('Content-Type: application/json;charset=utf-8');

class FuncController extends Backend2
{
    public $websites;
    public $source_link = '//rte.gogo198.cn';

    public function __construct(Request $request)
    {
        parent::__construct();

        $dat = $request->except(['_token']);
        #判断有无企业id
        $cid = isset($dat['cid']) ? intval($dat['cid']) : 0;

        if (empty($cid)) {
            $cid = cookie::get('cid');
        }

        if (empty($cid)) {
            echo '<h1>商家站点ID不能为空，正在跳转至淘中国</h1><script>setTimeout(function(){ window.location.href="//www.gogo198.cn"; },1000);</script>';
        }

        #获取商户的企业配置的基本信息
        $this->websites['cid'] = $cid;
        $domain = $request->getHost();
        $this->websites['domain'] = 'https://'.$domain.'/?cid='.$cid;
        $this->websites['rand'] = rand(11111, 99999);
        $this->websites['info'] = Db::connection('shop_db')->table('website_basic')->where(['company_id'=>$cid])->first();
        $this->websites['info'] = objtoarr($this->websites['info']);

        #获取公示信息
        $this->websites['info']['publicity_info'] = json_decode($this->websites['info']['publicity_info'], true);

        #获取搜索结果展示版式
        if (!empty($this->websites['info']['search_format'])) {
            $this->websites['info']['search_format'] = json_decode($this->websites['info']['search_format'], true);
        } else {
            $this->websites['info']['search_format'] = [5,5];
        }

        #获取商户的企业配置的头部菜单
        $this->websites['menu'] = Db::connection('shop_db')->table('website_navbar')->where(['company_id'=>$cid,'pid'=>0])->get();
        $this->websites['menu'] = objtoarr($this->websites['menu']);
        foreach ($this->websites['menu'] as $k=>$v) {
            $this->websites['menu'][$k]['children'] = Db::connection('shop_db')->table('website_navbar')->where(['company_id'=>$cid,'pid'=>$v['id']])->get();
            $this->websites['menu'][$k]['children'] = objtoarr($this->websites['menu'][$k]['children']);
            foreach ($this->websites['menu'][$k]['children'] as $k2=>$v2) {
                $this->websites['menu'][$k]['children'][$k2]['children'] = Db::connection('shop_db')->table('website_navbar')->where(['company_id'=>$cid,'pid'=>$v2['id']])->get();
                $this->websites['menu'][$k]['children'][$k2]['children'] = objtoarr($this->websites['menu'][$k]['children'][$k2]['children']);
            }
        }

        #获取页脚功能菜单
        $this->websites['footer_menu'] = Db::connection('shop_db')->table('website_footer')->where(['company_id'=>$cid,'pid'=>0])->get();
        $this->websites['footer_menu'] = objtoarr($this->websites['footer_menu']);
        foreach ($this->websites['footer_menu'] as $k=>$v) {
            $this->websites['footer_menu'][$k]['children'] = Db::connection('shop_db')->table('website_footer')->where(['company_id'=>$cid,'pid'=>$v['id']])->get();
            $this->websites['footer_menu'][$k]['children'] = objtoarr($this->websites['footer_menu'][$k]['children']);
        }

        #获取社媒
        $this->websites['website_contact'] = Db::connection('shop_db')->table('website_contact')->where(['company_id'=>$cid])->get();
        $this->websites['website_contact'] = objtoarr($this->websites['website_contact']);

        #获取资质
        $this->websites['website_qualification'] = Db::connection('shop_db')->table('merchsite_qualification')->where(['company_id'=>$cid])->get();
        $this->websites['website_qualification'] = objtoarr($this->websites['website_qualification']);

        #客服信息
        $this->websites['customer'] = Db::connection('shop_db')->table('merchsite_customer_group')->where(['company_id'=>$cid])->first();
        $this->websites['customer'] = objtoarr($this->websites['customer']);
    }

    #去除重复字段
    public function hasDuplicateField($arr, $field)
    {
        $values = [];
        foreach ($arr as $row) {
            $values[] = $row[$field];
        }

        $uniqueValues = array_unique($values);
        return $uniqueValues;
    }

    #淘中国列表
    public function tao_zhongguo(Request $request)
    {
        $data = $request->except(['_token']);
        if (isset($data['pa'])) {
            if ($data['pa']==1) {
                $id = isset($data['id']) ? intval($data['id']) : 0;#框架id
                $catename = trim($data['cate_name']);#关键字搜索

                #先查询有无此商品名称
                #后再查询分类名称
                $cateinfo1 = Db::table('goods')->where([['goods_name', 'like', '%'.$catename.'%'],['goods_status','=',1]])->first();
                $cateinfo1 = objtoarr($cateinfo1);

                if ($cateinfo1['goods_id']>0) {
                    $list = Db::table('goods')->where([['goods_name', 'like', '%'.$catename.'%'],['goods_status','=',1]])->get();
                    $list = objtoarr($list);
                    if (!empty($list)) {
                        $condition = $this->get_condition($id, $list, 1);
                        return Response()->json(['code'=>-1,'id'=>0,'msg'=>'搜索成功','data'=>$list,'condition'=>$condition]);
                    } else {
                        $list = $this->get_goods($catename);
                        $new_list = $this->save_goods($list['data']);
                        if ($list['code']==0) {
                            $condition = $this->get_condition($id, $new_list, 1);
                            return Response()->json(['code'=>-1,'id'=>0,'msg'=>'搜索成功','data'=>$new_list,'condition'=>$condition]);
                        } elseif ($list['code']==-1) {
                            return Response()->json(['code'=>-2,'id'=>0,'msg'=>'暂无信息','data'=>'','condition'=>'']);
                        }
                    }
                } else {
                    $cateinfo1 = Db::table('category')->where(['cat_name'=>$catename])->first();
                    $cateinfo1 = objtoarr($cateinfo1);

                    if (!empty($cateinfo1)) {
                        $list = Db::table('goods')->where(['cat_id'=>$cateinfo1['cat_id'],'goods_status'=>1])->get();
                        $list = objtoarr($list);
                        if (!empty($list)) {
                            $condition = $this->get_condition($id, $list, 1);
                            return Response()->json(['code'=>-1,'id'=>0,'msg'=>'搜索成功','data'=>$list,'condition'=>$condition]);
                        } else {
                            $list = $this->get_goods($catename);
                            $new_list = $this->save_goods($list['data']);
                            if ($list['code']==0) {
                                $condition = $this->get_condition($id, $new_list, 1);
                                return Response()->json(['code'=>-1,'id'=>0,'msg'=>'搜索成功','data'=>$new_list,'condition'=>$condition]);
                            } elseif ($list['code']==-1) {
                                return Response()->json(['code'=>-2,'id'=>0,'msg'=>'暂无信息','data'=>'','condition'=>'']);
                            }
                        }
                    } else {
                        return Response()->json(['code'=>-2,'id'=>0,'msg'=>'暂无信息','data'=>'','condition'=>'']);
                    }
                }
            } elseif ($data['pa']==2) {
                #获取城市
                $res = httpRequest('https://shop.gogo198.cn/collect_website/public/?s=api/gather/gettableinfo', ['id' => 5,'province_id'=>$data['province_id']]);
                $res2 = json_decode($res, true);
                $res = json_decode($res2['list'], true);
//                    session('city_list', $res);
//                    $request->session()->put('country_list', $res);
                if (!empty($res)) {
                    return Response()->json(['code'=>0,'data'=>$res]);
                } else {
                    return Response()->json(['code'=>-1,'data'=>'']);
                }
            }
        } else {
            $cate_name = isset($data['cate_name']) ? $data['cate_name'] : '';
            return view('func.tao_zg', compact('cate_name'));
        }
    }

    #商品列表
    public function goods_list(Request $request)
    {
        header('Content-Type: text/html; charset=utf-8');
        $data = $request->except(['_token']);
        $hotsearchId = isset($data['hotsearchId']) ? intval($data['hotsearchId']) : 0;#导页id、节日id、轮播id、发现id
        $searchTitle = isset($data['searchTitle']) ? trim($data['searchTitle']) : '';#板块名称
        #当前页面的链接
        $origin_page = '/';

        if (isset($data['pa2'])) {
        } else {
            $currency_sel = isset($data['currency_sel']) ? trim($data['currency_sel']) : 158;
            $catename = isset($data['cate_name']) ? trim($data['cate_name']) : '';#关键字搜索
            $id = isset($data['frame_id']) ? intval($data['frame_id']) : 0;//1导页数据、2节日、3首页轮播、4发现好货
            $sort_info = isset($data['sort_info']) ? trim($data['sort_info']) : 0;

            #获取商户配置的展示版式
            $calc_limit = $this->websites['info']['search_format'][0] * $this->websites['info']['search_format'][1];#N行N个

            #分页数据====================
            $goods_count = isset($data['goods_count']) ? intval($data['goods_count']) : 0;
            $limit = $calc_limit;
            $page = isset($data['page']) ? (intval($data['page']) - 1) * $limit : 0;#【0*10,10】【1*10,10】【2*10,10】
            #分页数据====================

            #高级条件====START
            $origin_condition = isset($data['g_condition']) ? trim($data['g_condition']) : '';
            $g_condition = isset($data['g_condition']) ? base64_decode($origin_condition) : '';
            $g_o = $g_condition;
            if (!empty($g_condition)) {
                $g_condition = explode('@@@', rtrim($g_condition, '@@@'));
            }
            $origin_field_condition = isset($data['field_condition']) ? $data['field_condition'] : '';
            $field_condition = isset($data['field_condition']) ? base64_decode(str_replace(' ', '', $origin_field_condition)) : '';
            $field_condition = json_decode($field_condition, true);

            //二级字段条件
            $condition_arr2 = isset($data['condition_arr2']) ? trim($data['condition_arr2']) : '';

            #高级条件======END

            $result = '没找到相关的商品';
            $minprice = 0;
            $maxprice = 0;
            if ($hotsearchId>0) {
                #查找该板块的关键字
                $keywords = [];
                if ($id==1) {
                    #导页
                    $get_keywords = Db::table('guide_content')->where(['id'=>$hotsearchId,'company_id'=>$this->websites['cid']])->first();
                    $get_keywords = objtoarr($get_keywords);

                    #1.1、获取当前导流板块关键字
                    $datas = Db::table('merchsite_guide_body')->where(['id'=>$get_keywords['pid']])->first();
                    $datas = objtoarr($datas);
                    $shelf_keywords = '';
                    #1.2、获取当前导流板块的商户上架关键字
                    $goods_shelf = Db::table('goods_shelf')->where(['type'=>1,'guide_id'=>$get_keywords['pid']])->get();
                    $goods_shelf = objtoarr($goods_shelf);
                    #1.3、对比导流板块关键字是否与商家上架关键字有匹配
                    foreach ($goods_shelf as $k=>$v) {
                        $arr1 = explode('、', $datas['gkeywords']);
                        $arr2 = explode('、', $v['keywords']);
                        $intersection = array_intersect($arr1, $arr2);
                        if (!empty($intersection)) {
                            foreach ($intersection as $k2=>$v2) {
                                #1.4、判断关键字表有无此关键字，无则插入并设置为已爬完
                                $ishave = Db::table('goods_keywords')->where(['keywords'=>$v2])->first();
                                $ishave = objtoarr($ishave);
                                $keywordsId = 0;
                                if (empty($ishave)) {
                                    $keywordsId = Db::table('goods_keywords')->insertGetId([
                                        'keywords'=>trim($v2),
                                        'get_times'=>0,
                                        'is_done'=>1,
                                        'is_merch'=>1
                                    ]);
                                } else {
                                    $keywordsId = $ishave['id'];
                                }
                                Db::table('goods')->where(['goods_id'=>$v['gid']])->update(['keywords_id'=>$keywordsId]);
                                $shelf_keywords .= $v2.'、';
                            }
                        }
                    }

                    if (empty($shelf_keywords)) {
                        $keywords = explode('、', $get_keywords['gkeywords']);
                    } else {
                        $keywords = explode('、', $get_keywords['gkeywords'].'、'.rtrim($shelf_keywords, '、'));
                    }
                } elseif ($id==2) {
                    #节日
                    $get_keywords = Db::connection('shop_db')->table('website_festival')->where(['id'=>$hotsearchId])->first();
                    $get_keywords = objtoarr($get_keywords);

                    $keywords = explode('、', $get_keywords['keywords']);
                } elseif ($id==3) {
                    #轮播
                    $get_keywords = Db::connection('shop_db')->table('website_rotate')->where(['id'=>$hotsearchId,'company_id'=>$this->websites['cid']])->first();
                    $get_keywords = objtoarr($get_keywords);
                    $keywords = explode('、', $get_keywords['other_keywords']);
                } elseif ($id==4) {
                    #发现好货
                    $get_keywords = Db::connection('shop_db')->table('website_discovery_list')->where(['id'=>$hotsearchId,'company_id'=>$this->websites['cid']])->first();
                    $get_keywords = objtoarr($get_keywords);
                    $keywords = explode('、', $get_keywords['other_keywords']);
                }

                $keywords_id = [];
                foreach ($keywords as $k=>$v) {
                    $this_keyword = Db::table('goods_keywords')->where(['keywords'=>$v])->first();
                    $this_keyword = objtoarr($this_keyword);
                    array_push($keywords_id, $this_keyword['id']);
                }
                $cateinfo1 = Db::table('goods')->where(['shop_id'=>$this->websites['cid']])->whereIn('keywords_id', $keywords_id)->first();
                $cateinfo1 = objtoarr($cateinfo1);

                $list = [];
                $condition = [];
                if ($cateinfo1['goods_id']>0) {
                    #获取高级条件
                    $list_info = $this->getTotalWhere($catename, $g_condition, $field_condition, $condition_arr2, [['goods_status','=',1],['shop_id','=',$this->websites['cid']]], $keywords_id, $sort_info, ['page'=>$page,'limit'=>$limit]);

                    $list = $list_info[0];
                    $goods_count = $list_info[1];
                    $minprice = $list_info[2];
                    $maxprice = $list_info[3];
//                    if($hotsearchId==0) {
                    #获取原“商品名称/分类名称”的条件
//                    ,['hotsearch_id', '=', $hotsearchId]
                    $list2 = Db::table('goods')->where(['shop_id'=>$this->websites['cid']])->whereIn('keywords_id', $keywords_id)->get();
                    $list2 = objtoarr($list2);
                    $condition = $this->get_condition($id, $list2, 1, ['value_show'=>0,'brand_show'=>0]);
//                    }
                } else {
                    $result = '暂无商品';
                    #执行爬虫任务(废弃)
                    if (1>2) {
                        $conditions = Db::table('guide_content')->whereRaw('gkeywords<>"" and is_show=0 and id='.$hotsearchId)->first();
                        $conditions = objtoarr($conditions);

                        if (!empty($conditions['gkeywords'])) {
                            $keywords = explode('、', $conditions['gkeywords']);
                            foreach ($keywords as $k2=>$v2) {
                                #keyword_query
                                $size = 20;
                                $options = [
                                    'http' => [
                                        'timeout' => 10000, // 设置超时时间为3000秒
                                    ],
                                ];
                                $context = stream_context_create($options);
                                $goods = json_decode(file_get_contents('https://shop.gogo198.cn/collect_website/public/?s=api/getgoods/keyword_query&current='.$conditions['get_times'].'&size='.$size.'&keyword='.$v2, false, $context), true);
                                if (!empty($goods['data'])) {
                                    #1、先获取表里是否存在此商品
                                    $list = $this->save_goods($goods['data'], $hotsearchId);
                                    sleep(1);
                                    $goods_count = Db::table('goods')->where(['hotsearch_id'=>$hotsearchId])->count();
                                    $goods_count = $this->get_fiveList($goods_count);
                                    $list = Db::table('goods')->where(['hotsearch_id'=>$hotsearchId])->offset($page)->limit($limit)->get();
                                    $list = objtoarr($list);

//                                if($hotsearchId==0) {
                                    #获取原“商品名称/分类名称”的条件
                                    $list2 = Db::table('goods')->where([['hotsearch_id', '=', $hotsearchId]])->get();
                                    $list2 = objtoarr($list2);
                                    $condition = $this->get_condition($id, $list2, 1, ['value_show'=>0,'brand_show'=>0]);
//                                }
                                    #3、爬取次数++
                                    $current = $conditions['get_times']+1;
                                    Db::table('guide_content')->where(['id'=>$conditions['id']])->update(['get_times'=>$current]);
                                }
                            }
                        }
                    }
                }

                #当前页面的链接
                $origin_page = '/login.html?open=4&param2='.base64_encode('/goods_list?frame_id='.$data['frame_id'].'&hotsearchId='.$hotsearchId.'&searchTitle='.$searchTitle);
            } else {
                $searchTitle = $catename;
                #先查询有无此商品名称
                #后再查询分类名称
                $cateinfo1 = Db::table('goods')->where(['shop_id'=>$this->websites['cid']])->where('goods_name', 'like', '%'.$catename.'%')->first();
                $cateinfo1 = objtoarr($cateinfo1);

                $list = [];
                $condition = [];
                if ($cateinfo1['goods_id']>0) {
                    #获取高级条件

                    $list_info = $this->getTotalWhere($catename, $g_condition, $field_condition, $condition_arr2, [['goods_name', 'like', '%'.$catename.'%'],['goods_status','=',1],['shop_id','=',$this->websites['cid']]], [], $sort_info, ['page'=>$page,'limit'=>$limit]);

                    $list = $list_info[0];
                    $goods_count = $list_info[1];
                    $minprice = $list_info[2];
                    $maxprice = $list_info[3];
                    #获取原“商品名称/分类名称”的条件
                    $list2 = Db::table('goods')->where([['goods_name', 'like', '%'.$catename.'%'],['shop_id','=',$this->websites['cid']]])->get();
                    $list2 = objtoarr($list2);
                    $condition = $this->get_condition($id, $list2, 1, ['value_show'=>0,'brand_show'=>0]);
                } else {
                    $cateinfo1 = Db::table('category')->where(['cat_name'=>$catename])->first();
                    $cateinfo1 = objtoarr($cateinfo1);

                    #获取高级条件
                    $list_info = $this->getTotalWhere($catename, $g_condition, $field_condition, $condition_arr2, [['cat_id', '=', $cateinfo1['cat_id']],['goods_status','=',1],['shop_id','=',$this->websites['cid']]], $sort_info, ['page'=>$page,'limit'=>$limit]);
                    $list = $list_info[0];
                    $goods_count = $list_info[1];
                    $minprice = $list_info[2];
                    $maxprice = $list_info[3];

                    #获取原“商品名称/分类名称”的条件
                    $list2 = Db::table('goods')->where(['cat_id'=>$cateinfo1['cat_id'],'shop_id','=',$this->websites['cid']])->get();
                    $list2 = objtoarr($list2);
                    $condition = $this->get_condition($id, $list2, 1, ['value_show'=>1,'brand_show'=>1]);
                }

                #当前页面的链接
                $origin_page = '/login.html?open=4&param2='.base64_encode('/goods_list?cate_name='.$catename);
            }
//            dd($keywords_id);

            #币种转换
            if (!empty($list)) {
                foreach ($list as $k=>$v) {
                    if ($currency_sel==158) {
                        $list[$k]['goods_currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$v['goods_currency']])->first()->currency_symbol_standard;
                    } else {
                        $currency_info = Db::connection('shop_db')->table('website_exchange_rate')->where(['id'=>$currency_sel])->first();
                        $currency_info = objtoarr($currency_info);

                        $list[$k]['goods_currency'] = $currency_info['symbol'];
                        $list[$k]['goods_price'] = sprintf('%.2f', $currency_info['rate'] * $v['goods_price']);
                    }
                }
            }
            if (isset($data['pa'])) {
                return Response()->json(['code'=>0,'data'=>$list]);
            }

            #获取配置信息
            $data = ['websites'=>$this->websites,'source_link'=>$this->source_link];


//            dd($condition);

            #币种
            $currency = Db::connection('shop_db')->table('website_exchange_rate')->get();
            $currency = objtoarr($currency);

            #价格排序参数
            $sort = 0;
            if (!empty($sort_info)) {
                $sort = explode('_', $sort_info)[1];
            }

            #二级字段
            $two_fields = Db::table('merchsite_search_column_two')->where(['company_id'=>$this->websites['cid']])->get();
            $two_fields = objtoarr($two_fields);

            return view('func.goods_list', compact('condition', 'list', 'data', 'origin_field_condition', 'field_condition', 'origin_condition', 'g_condition', 'catename', 'id', 'g_o', 'sort_info', 'sort', 'hotsearchId', 'goods_count', 'limit', 'currency', 'currency_sel', 'minprice', 'maxprice', 'result', 'searchTitle', 'origin_page', 'two_fields', 'condition_arr2'));
        }
    }

    #5个显示，不满5个不显示（废弃）
    public function get_fiveList($goods_count=0, $list=[])
    {
        #整除5，每行显示5个
        if ($goods_count%5!=0) {
            #4,119
            $goods_count -= 1;
            array_pop($list);
            if ($goods_count%5!=0) {
                #3,118
                $goods_count -= 1;
                array_pop($list);
                if ($goods_count%5!=0) {
                    #2,117
                    $goods_count -= 1;
                    array_pop($list);
                    if ($goods_count%5!=0) {
                        #1,116
                        $goods_count -= 1;
                        array_pop($list);
                    }
                }
            }
        }
        return [$goods_count,$list];
    }

    #列表页根据高级条件搜索
    public function getTotalWhere($catename, $g_condition, $field_condition, $condition_arr2, $where, $whereIn, $sort_info='', $limit=['page'=>0,'limit'=>10])
    {
        #条件存在时，打包搜索
        $opt_arr = [];
        if (!empty($g_condition)) {
            #商品字段条件
            foreach ($g_condition as $k=>$v) {
                $now_val = explode('_', $v);
                if ($now_val[0]=='cate') {
                    $where = array_merge($where, [['cat_id','=',$now_val[1],'or']]);
                } elseif ($now_val[0]=='opt') {
                    $now_val = explode('|', $now_val[1]);
                    $opt_arr = array_merge($opt_arr, [['attr_id'=>$now_val[0],'attr_vid'=>$now_val[1]]]);
                } elseif ($now_val[0]=='brand') {
                    $where = array_merge($where, [['brand_id','=',$now_val[1],'or']]);
                }
            }
        }

        if (!empty($field_condition)) {
            #自定字段条件
            $field_condition2 = [];
            foreach ($field_condition as $k=>$v) {
                if (empty($field_condition2)) {
                    $field_condition2 = array_merge($field_condition2, [$v]);
                } else {
                    foreach ($field_condition2 as $k2=>$v2) {
                        if ($v2['id']==$v['id']) {
                            $field_condition2[$k2]['val'] .=  '_'.$v['val'];
                            break;
                        } else {
                            $field_condition2 = array_merge($field_condition2, [$v]);
                            break;
                        }
                    }
                }
            }

            foreach ($field_condition2 as $k=>$v) {
                $column_condition = Db::table('search_column')->where(['id'=>$v['id']])->first();
                $column_condition = objtoarr($column_condition);
                if ($column_condition['stype']==1) {
                    #价幅
                    $num = explode('_', $v['val']);
                    if ($num[1]>0 && !empty($column_condition['field'])) {
                        $where = array_merge($where, [[$column_condition['field'],'>=',$num[0],'and']]);
                        $where = array_merge($where, [[$column_condition['field'],'<=',$num[1],'and']]);
                    }
                } elseif ($column_condition['stype']==2) {
                    #下拉选择 todo 下拉选择可能要选表中参数
                    if (!empty($column_condition['field'])) {
                        $where = array_merge($where, [[$column_condition['field'],'=',$v['val'],'and']]);
                    }
                } elseif ($column_condition['stype']==3) {
                    #单选参数 todo 有些参数是1/2/3的，请求只会给0/1
                    if (!empty($column_condition['field'])) {
                        $where = array_merge($where, [[$column_condition['field'],'=',$v['val'],'and']]);
                    }
                } elseif ($column_condition['stype']==4) {
                    #发货地区
                    if (!empty($column_condition['field'])) {
                        $area = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['code_name'=>$v['val']])->first();
                        $where = array_merge($where, [[$column_condition['field'],'=',$area->id,'and']]);
                    }
                }
            }
        }

        #二级字段
        if (!empty($condition_arr2)) {
            $condition_arr2 = explode('、', $condition_arr2);
            foreach ($condition_arr2 as $k=>$v) {
                if (!empty($v)) {
                    $value = Db::table('merchsite_search_column_two')->where(['id'=>$v])->first();
                    $value = objtoarr($value);
                    $where = array_merge($where, [[$value['field'],'=',1,'and']]);
                }
            }
        }

        if (empty($whereIn)) {
            #总数量
            $count = Db::table('goods')->where($where)->count();

            #价钱——最低值/最高值
            $minprice = Db::table('goods')->where($where)->min('goods_price');
            $maxprice = Db::table('goods')->where($where)->max('goods_price');
        } else {
            #总数量
            $count = Db::table('goods')->where($where)->whereIn('keywords_id', $whereIn)->count();

            #价钱——最低值/最高值
            $minprice = Db::table('goods')->where($where)->whereIn('keywords_id', $whereIn)->min('goods_price');
            $maxprice = Db::table('goods')->where($where)->whereIn('keywords_id', $whereIn)->max('goods_price');
        }


        #按“x”字段排序商品
        if ($sort_info!=0 && !empty($sort_info)) {
            $sort_info = explode('_', $sort_info);
            $sort_field = Db::table('search_column')->where(['id'=>$sort_info[0]])->first();
            if ($sort_info[1]==1) {
                #升序
                if (empty($whereIn)) {
                    $list = Db::table('goods')->where($where)->offset($limit['page'])->limit($limit['limit'])->orderBy($sort_field->field, 'asc')->get();
                } else {
                    $list = Db::table('goods')->where($where)->whereIn('keywords_id', $whereIn)->offset($limit['page'])->limit($limit['limit'])->orderBy($sort_field->field, 'asc')->get();
                }
            } elseif ($sort_info[1]==2) {
                #降序
                if (empty($whereIn)) {
                    $list = Db::table('goods')->where($where)->offset($limit['page'])->limit($limit['limit'])->orderBy($sort_field->field, 'desc')->get();
                } else {
                    $list = Db::table('goods')->where($where)->whereIn('keywords_id', $whereIn)->offset($limit['page'])->limit($limit['limit'])->orderBy($sort_field->field, 'desc')->get();
                }
            }
        } else {
            #无排序（最新>最旧）
            if (empty($whereIn)) {
                $list = Db::table('goods')->where($where)->offset($limit['page'])->limit($limit['limit'])->get();
            } else {
                $list = Db::table('goods')->where($where)->whereIn('keywords_id', $whereIn)->offset($limit['page'])->limit($limit['limit'])->get();
            }
        }
        $list = objtoarr($list);

        $list2 = [];#出现过任何规格相同的商品id，将要保留在数组
        if (!empty($opt_arr) && !empty($list)) {
            foreach ($list as $k=>$v) {
                foreach ($opt_arr as $k2=>$v2) {
                    $ishave = Db::table('goods_spec')->where(['attr_id'=>$v2['attr_id'],'attr_vid'=>$v2['attr_vid'],'goods_id'=>$v['goods_id']])->first();
                    if (!empty($ishave->spec_id)) {
                        if (!in_array($list[$k], $list2)) {
                            $list2 = array_merge($list2, [$list[$k]]);
                        }
                    }
                }
            }
            $list = $list2;
            $count = count($list);
        }

        #处理商家商品价格问题
        foreach ($list as $key=>$item) {
            if ($item['goods_price']==0) {
                $sku_info = Db::table('goods_sku')->where(['sku_id'=>$item['sku_id']])->first();
                $sku_info = objtoarr($sku_info);
                $sku_info['sku_prices'] = json_decode($sku_info['sku_prices'], true);
                $list[$key]['goods_price'] = number_format(end($sku_info['sku_prices']['price']), 2);
            }
        }

//        $info = $this->get_fiveList($count,$list);
//        $count = $info[0];
//        $list = $info[1];

        #排序
//        if($sort_info!=0 && !empty($sort_info)){
//            $sort_info = explode('_',$sort_info);
//            $sort_field = Db::table('search_column')->where(['id'=>$sort_info[0]])->first();
//            if($sort_info[1]==1){
//                #升序
//                if($sort_field->field=='goods_price'){
//                    usort($list, function($a, $b) {
//                        return $a['goods_price'] <=> $b['goods_price'];
//                    });
//                }
//            }
//            elseif($sort_info[1]==2){
//                #降序
//                if($sort_field->field=='goods_price') {
//                    usort($list, function ($a, $b) {
//                        return $b['goods_price'] <=> $a['goods_price'];
//                    });
//                }
//            }
//        }

        return [$list,$count,$minprice,$maxprice];
    }

    #浮框&列表页获取条件数组
    #$id//1导页数据、2节日、3首页轮播、4发现好货
    public function get_condition($id, $list, $type, $show=['value_show'=>0,'brand_show'=>0])
    {
        #条件============START
        $condition = [
            'category'=>[],
            'options'=>[],
            'brand'=>[],
        ];
        $cate_id = 0;
        foreach ($list as $k=>$v) {
            #1、获取当前分类的同级分类作为条件
            if ($cate_id==0) {
                if ($v['cat_id']>0) {
                    $cate_id = $v['cat_id'];
                    #1.1、查找同级分类
                    $last_cat = Db::table('category')->where(['cat_id'=>$v['cat_id']])->first();
                    $category = Db::table('category')->where(['parent_id'=>$last_cat->parent_id])->get();
                    $condition['category'] = objtoarr($category);
                }
            }

            if ($show['value_show']==1) {
                #2、获取所有商品的所有规格/属性
                if ($v['have_specs']==1) {
                    $sku = Db::table('goods_sku')->where(['goods_id'=>$v['goods_id']])->get();
                    $sku = objtoarr($sku);

                    foreach ($sku as $k2=>$v2) {
                        if (empty($condition['options'])) {
                            $condition['options'] = array_merge($condition['options'], [[
                                'spec_ids'=>$v2['spec_ids'],
                                'children2'=>[$v2['spec_vids']],
                            ]]);
                        } else {
                            foreach ($condition['options'] as $k3=>$v3) {
                                if ($v3['spec_ids']==$v2['spec_ids']) {
                                    $condition['options'][$k3]['children2'] = array_merge($condition['options'][$k3]['children2'], [$v2['spec_vids']]);
                                }
                            }
                        }
                    }
                }
            }

            if ($show['brand_show']==1) {
                #5、获取品牌
                if ($v['brand_type'] == 1) {
                    $brand = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['pid' => 8, 'id' => $v['brand_id']])->first();
                    $condition['brand'] = array_merge($condition['brand'], [['type' => 1, 'name' => $brand->param1, 'id' => $brand->id]]);
                }
            }
        }

        if ($show['value_show']==1) {
            #3、去除重复规格、品牌
            foreach ($condition['options'] as $k => $v) {
                $condition['options'][$k]['children2'] = array_values(array_unique($v['children2']));
                $condition['options'][$k]['spec_name'] = Db::table('attribute')->where(['attr_id' => $v['spec_ids']])->first()->attr_name;
                foreach ($condition['options'][$k]['children2'] as $k2 => $v2) {
                    $condition['options'][$k]['children'][$k2]['value_id'] = $v2;
                    $condition['options'][$k]['children'][$k2]['value_name'] = Db::table('attr_value')->where(['attr_vid' => $v2])->first()->attr_vname;
                }
                unset($condition['options'][$k]['children2']);
            }
        }
        if ($show['brand_show']==1) {
            $condition['brand'] = $this->hasDuplicateField($condition['brand'], 'name');
        }

        #4、查询框架自定条件
//        $data = Db::table('search_list')->where(['id'=>$id])->first();
        $data = Db::table('search_list')->where(['id'=>1])->first();
        $data = objtoarr($data);
        if (!empty($data['content'])) {
            $data['column_content'] = Db::table('search_column')->whereRaw('find_in_set(id,?)', [$data['content']])->whereRaw('type <> 1')->get();
            $data['column_content'] = objtoarr($data['column_content']);
            foreach ($data['column_content'] as $k=>$v) {
                $data['column_content'][$k]['content'] = json_decode($v['content'], true);
                if (!empty($data['column_content'][$k]['content'])) {
                    $data['column_content'][$k]['content'] = explode('、', $data['column_content'][$k]['content']);
                }

                if ($v['stype']==4) {
                    #获取国家的省
                    if (!empty(session('province_list'))) {
                        $condition['province'] = session('province_list');
                    } else {
                        $res = httpRequest('https://shop.gogo198.cn/collect_website/public/?s=api/gather/gettableinfo', ['id' => 4,'country_id'=>162]);
                        $res2 = json_decode($res, true);
                        $res = json_decode($res2['list'], true);
                        session('province_list', $res);
//                    $request->session()->put('country_list', $res);
                        $condition['province'] = $res;
                    }
                }
            }
        }
        $condition['column_content'] = $data['column_content'];
        #条件============END

        return $condition;
    }

    #保存查询到的商品到数据表
    public function save_goods($list, $hotsearchId=0)
    {
        foreach ($list as $k=>$v) {
            if (isset($v['goodsLink'])) {
                $ishave = Db::table('goods')->where(['other_goods_id'=>$v['goodsId']])->first();
                $ishave = objtoarr($ishave);
                $time = time();
                $date = date('Y-m-d H:i:s');

                if (empty($ishave)) {
                    $new_goods = httpRequest('https://shop.gogo198.cn/collect_website/public/?s=api/getgoods/detail_query', json_encode(['type'=>2,'goodsLink'=>$v['goodsLink']], true), ['Content-Type: application/json']);
                    $new_goods = json_decode($new_goods, true);

                    #查看商品的计量单位
                    if (isset($new_goods['data']['repositoryInfo']['quantityText'])) {
                        $quantityText = mb_substr($new_goods['data']['repositoryInfo']['quantityText'], -1);
                        $unit = Db::connection('shop_db')->table('unit')->where(['code_name'=>$quantityText])->first()->code_value;
                        if (empty($unit)) {
                            $unit = '011';
                        }
                    } else {
                        $unit = '011';
                    }

                    if ($new_goods['code']==0 && isset($new_goods['data']['goodsDetailHtml'])) {
                        try {
                            #获取商品分类==START
                            $last_catId = ['cat_id'=>0,'parent_id'=>0];
                            $cat_id1 = 0;#一级
                            $cat_id = 0;#最后一级
                            $cat_id2 = 0;#最后一级

                            if (isset($new_goods['data']['goodsCatName'])) {
                                $last_catId = Db::table('category')->where(['cat_name' => $new_goods['data']['goodsCatName']])->first();
                                $last_catId = objtoarr($last_catId);
                                if (!empty($last_catId)) {
                                    #自己的分类表有
                                    $cat_id = intval($last_catId['cat_id']);
                                    $cat_id2 = intval($last_catId['cat_id']);#最后一级
                                    #获取第一级
                                    $first_catId = Db::table('category')->where(['cat_id' => $last_catId['parent_id']])->first();
                                    $first_catId = objtoarr($first_catId);
                                    if ($first_catId['parent_id'] > 0) {
                                        $first_catId = Db::table('category')->where(['cat_id' => $first_catId['parent_id']])->first();
                                        $first_catId = objtoarr($first_catId);
                                        if ($first_catId['parent_id'] > 0) {
                                            $first_catId = Db::table('category')->where(['cat_id' => $first_catId['parent_id']])->first();
                                            $first_catId = objtoarr($first_catId);
                                            $cat_id1 = $first_catId['cat_id'];
                                        } else {
                                            $cat_id1 = $first_catId['cat_id'];
                                        }
                                    }
                                } else {
                                    #查询其他平台的分类表，并获取名称判断原分类表有无，无的话就插入/有的话就->获取分类ID
                                    $last_catId = Db::table('category_backydrop')->where(['name' => $new_goods['data']['goodsCatName']])->first();
                                    $last_catId = objtoarr($last_catId);
                                    if (!empty($last_catId)) {
                                        #搜索其他平台的分类表，找到三级分类后插入原分类表，并依次获取分类id

                                        #获取第二级
                                        $ishave2 = Db::table('category_backydrop')->where(['id' => $last_catId['pid']])->first();
                                        $ishave2 = objtoarr($ishave2);
                                        if ($ishave2['pid']>0) {
                                            #获取第一级
                                            $ishave1 = Db::table('category_backydrop')->where(['id' => $ishave2['pid']])->first();
                                            $ishave1 = objtoarr($ishave1);
                                            if ($ishave1['id']>0) {
                                                #开始插入原分类表
                                                $ishave_name = Db::table('category')->where(['cat_name'=>$ishave1['name']])->first();
                                                $ishave_name = objtoarr($ishave_name);

                                                #第一级
                                                if (empty($ishave_name['cat_id'])) {
                                                    $cat_id1 = Db::table('category')->insertGetId([
                                                        'cat_name'=>$ishave1['name'],
                                                        'type_id'=>1,
                                                        'parent_id'=>0,
                                                        'cat_level'=>1,
                                                        'is_parent'=>1,
                                                        'is_show'=>1,
                                                        'created_at'=>$date
                                                    ]);
                                                } else {
                                                    $cat_id1 = $ishave_name['cat_id'];
                                                }

                                                #第二级
                                                $cat2_id = Db::table('category')->insertGetId([
                                                    'cat_name'=>$ishave2['name'],
                                                    'type_id'=>1,
                                                    'parent_id'=>$cat_id1,
                                                    'cat_level'=>2,
                                                    'is_parent'=>1,
                                                    'is_show'=>1,
                                                    'created_at'=>$date
                                                ]);

                                                #第三级
                                                $cat_id = Db::table('category')->insertGetId([
                                                    'cat_name'=>$last_catId['name'],
                                                    'type_id'=>1,
                                                    'parent_id'=>$cat2_id,
                                                    'cat_level'=>3,
                                                    'is_parent'=>0,
                                                    'is_show'=>1,
                                                    'created_at'=>$date
                                                ]);
                                                $cat_id2 = $cat_id;
                                            }
                                        }
                                    }
                                }
                            }
                            #获取商品分类====END

                            $good_id = Db::table('goods')->insertGetId([
                                'goods_name' => $new_goods['data']['goodsName'],
                                'shop_id' => 0,
                                'other_goods_id' => $new_goods['data']['goodsId'],
                                'other_spuCode' => $new_goods['data']['spuCode'],
                                'other_goods_link' => $new_goods['data']['goodsLink'],
                                'other_shop' => json_encode($new_goods['data']['shop'], true),
                                'other_platform' => $new_goods['data']['platform'],
                                'hotsearch_id'=>$hotsearchId,
                                'cat_id' => $cat_id,
                                'cat_id1' => $cat_id1,
                                'cat_id2' => $cat_id2,
                                'pc_desc' => $new_goods['data']['goodsDetailHtml'],
                                'goods_mode' => 0,
                                'brand_type' => 0,#空牌
                                'goods_status' => 1,
                                'click_count'=>mt_rand(111, 9999),
                                'star_count'=>mt_rand(111, 9999),
                                'share_count'=>mt_rand(111, 9999),
                                'created_at' => $date,
                                'sku_id' => 0,#（在下方插入规格id）
                                'goods_subname' => $new_goods['data']['goodsName'],
                                'goods_price' => $new_goods['data']['proPrice']['price'],
                                'market_price' => $new_goods['data']['proPrice']['price'],
                                'cost_price' => $new_goods['data']['proPrice']['price'],
                                'goods_number' => $new_goods['data']['repositoryInfo']['quantity'],
                                'goods_image' => $new_goods['data']['picUrl'],
                                'keywords' => $new_goods['data']['goodsName'],
                                'goods_audit' => 1,
                                'contract_ids' => 'a:4:{i:1;s:1:"0";i:2;s:1:"0";i:3;s:1:"0";i:5;s:1:"0";}',
                                'add_time' => $time,
                                'goods_moq' => 1,
                                'other_attrs' => serialize([
                                    'value_name0' => '', 'value_desc0' => '',
                                ]),#(接口/爬虫商品不需要填写这个)
                                'updated_at' => $date,
                            ]);

                            $have_specs = 1;
                            if (empty($new_goods['data']['productProps'])) {
                                #无规格
                                $goodsSkuInsert = [
                                    'goods_id' => $good_id,
                                    'market_price' => $new_goods['data']['proPrice']['price'],
                                    'goods_price' => $new_goods['data']['proPrice']['price'],
                                    'goods_number' => $new_goods['data']['repositoryInfo']['quantity'],
                                    'warn_number' => 0,
                                    'goods_sn' => $new_goods['data']['spuCode'],
                                    'goods_barcode' => '',
                                    'goods_stockcode' => '',
                                    'is_spu' => 1, // 无规格商品 是SPU商品
                                    'sku_prices' => json_encode([
                                        'goods_number' => $new_goods['data']['repositoryInfo']['quantity'],
                                        'start_num' => [1],
                                        'unit' => [$unit],
                                        'select_end' => [1],
                                        'end_num' => [$new_goods['data']['repositoryInfo']['quantity']],
                                        'currency' => [5],
                                        'price' => [$new_goods['data']['proPrice']['price']],
                                    ], true),#该规格的区间价格
                                    'created_at' => $date,
                                    'updated_at' => $date,
                                ];
                                Db::table('goods_sku')->insert($goodsSkuInsert);
                                Db::table('goods')->where(['goods_id'=>$good_id])->update([
                                    'nospecs'=>json_encode([
                                        'goods_number' => [$new_goods['data']['repositoryInfo']['quantity']],
                                        'start_num' => [1],
                                        'unit' => [$unit],
                                        'select_end' => [1],
                                        'end_num' => [$new_goods['data']['repositoryInfo']['quantity']],
                                        'currency' => [5],
                                        'price' => [$new_goods['data']['proPrice']['price']],
                                    ], true)
                                ]);
                                $have_specs = 2;
                            } else {
                                #有规格

                                #1、插入或查看有无该属性
                                foreach ($new_goods['data']['productProps'] as $gsKey => $item) {
                                    $ishave = Db::table('attribute')->where(['attr_name' => $item['propName']])->first();
                                    $ishave = objtoarr($ishave);
                                    if (empty($ishave['attr_id'])) {
                                        $new_goods['data']['productProps'][$gsKey]['attr_id'] = Db::table('attribute')->insertGetId([
                                            'attr_name' => $item['propName'],
                                            'is_spec' => 1,
                                            'created_at' => $date,
                                            'updated_at' => $date,
                                        ]);
                                    } else {
                                        $new_goods['data']['productProps'][$gsKey]['attr_id'] = $ishave['attr_id'];
                                    }

                                    #1.1、插入子属性
                                    $ishave2 = Db::table('attr_value')->where(['attr_vname' => $item['valueName'], 'attr_id' => $new_goods['data']['productProps'][$gsKey]['attr_id']])->first();
                                    $ishave2 = objtoarr($ishave2);
                                    if (empty($ishave2['attr_vid'])) {
                                        $new_goods['data']['productProps'][$gsKey]['attr_vid'] = Db::table('attr_value')->insertGetId([
                                            'attr_id' => $new_goods['data']['productProps'][$gsKey]['attr_id'],
                                            'attr_vname' => $item['valueName'],
                                            'attr_vsort' => $gsKey + 1,
                                            'created_at' => $date,
                                            'updated_at' => $date,
                                        ]);
                                    } else {
                                        $new_goods['data']['productProps'][$gsKey]['attr_vid'] = $ishave2['attr_vid'];
                                    }
                                }

                                #2、插入商品规格类别表
                                foreach ($new_goods['data']['productProps'] as $gsKey => $item) {
                                    $goodsSpecInsert = [
                                        'goods_id' => $good_id,
                                        'attr_id' => $item['attr_id'],
                                        'attr_vid' => $item['attr_vid'],
                                        'cat_id' => $cat_id,
                                        'attr_value' => $item['valueName'],
                                        'attr_desc' => '',
                                        'is_checked' => 1,
                                        'spec_sort' => $gsKey,
                                        'created_at' => $date,
                                        'updated_at' => $date,
                                    ];
                                    Db::table('goods_spec')->insert($goodsSpecInsert);
                                }

                                #3、插入规格表
                                foreach ($new_goods['data']['skuList'] as $k2 => $v2) {
                                    $spec_ids = [];#大规格
                                    $spec_vids = [];#子规格
                                    $spec_names = [];#大规格名称：子规格名称
                                    foreach ($v2['props'] as $k3 => $v3) {
                                        $spec_ids_arr = Db::table('attribute')->where(['attr_name' => $v3['propName']])->first()->attr_id;
                                        $spec_ids = array_merge($spec_ids, [$spec_ids_arr]);

                                        $spec_vids_arr = Db::table('attr_value')->where(['attr_vname' => $v3['valueName'],'attr_id'=>$spec_ids_arr])->first()->attr_vid;
                                        $spec_vids = array_merge($spec_vids, [$spec_vids_arr]);

                                        $spec_names = array_merge($spec_names, [$v3['propName'] . ':' . $v3['valueName']]);
                                    }
                                    $skuList = [
                                        'goods_id' => $good_id,
                                        'spec_ids' => implode('|', $spec_ids),
                                        'spec_vids' => implode('|', $spec_vids),
                                        'spec_names' => implode(' ', $spec_names),
                                        'sku_specs' => implode('*', $spec_vids),
                                        'goods_price' => $v2['price']['price'],
                                        'market_price' => $v2['price']['price'],
                                        'goods_number' => $v2['quantity'],
                                        'goods_sn' => $v2['skuCode'],
                                        'is_spu' => 0,// 商品有规格 不是SPU商品
                                        'sku_prices' => json_encode([
                                            'goods_number' => $v2['quantity'],
                                            'disabled_num' => 0,#0在售
                                            'start_num' => [1],
                                            'unit' => [$unit],
                                            'select_end' => [1],#1数值，2以上
                                            'end_num' => [$v2['quantity']],
                                            'currency' => [5],
                                            'price' => [$v2['price']['price']]
                                        ], true),
                                        'created_at' => $date,
                                        'updated_at' => $date,
                                    ];

                                    Db::table('goods_sku')->insert($skuList);
                                }
                            }

                            #调整前端所需的字段
                            $list[$k]['cat_id'] = $cat_id;
                            $list[$k]['have_specs'] = $have_specs;
                            $list[$k]['brand_type'] = 0;
                            $list[$k]['brand_id'] = 0;
                            $list[$k]['goods_id'] = $good_id;
                            $list[$k]['goods_price'] = $new_goods['data']['proPrice']['price'];
                            $list[$k]['goods_name'] = $new_goods['data']['goodsName'];
                            $list[$k]['goods_image'] = $new_goods['data']['picUrl'];

                            #4、设置商品的默认sku_id
                            $default_sku_id = Db::table('goods_sku')->where(['goods_id' => $good_id, 'checked' => 1])->orderBy('sku_id', 'asc')->first()->sku_id;
                            // 更新商品表 sku_id 为goods_sku 第一个
                            Db::table('goods')->where(['goods_id' => $good_id])->update(['sku_id' => $default_sku_id,'have_specs'=>$have_specs]);

                            #5、插入商品图片表
                            foreach ($new_goods['data']['mainItemImgs'] as $k2 => $v2) {
                                Db::table('goods_image')->insert([
                                    'goods_id' => $good_id,
                                    'spec_id' => 0,#商品规格类别表id，主要用作规格切换图片
                                    'path' => $v2,
                                    'is_default' => $k2 == 0 ? 1 : 0,
                                    'sort' => $k2 + 1,
                                    'created_at' => $date,
                                    'updated_at' => $date,
                                ]);
                            }
                        } catch (\Exception $e) {
                            echo '第'.$k.'个@ ';
                            print_r($e->getMessage());
                            exit();
                        }
                    }
                } else {
                    $list[$k]['cat_id'] = $ishave['cat_id'];
                    $list[$k]['have_specs'] = $ishave['have_specs'];
                    $list[$k]['brand_type'] = $ishave['brand_type'];
                    $list[$k]['brand_id'] = $ishave['brand_id'];
                    $list[$k]['goods_id'] = $ishave['goods_id'];
                    $list[$k]['goods_price'] = $ishave['goods_price'];
                    $list[$k]['goods_name'] = $ishave['goods_name'];
                    $list[$k]['goods_image'] = $ishave['goods_image'];
                }
            }
        }
        return $list;
    }

    #淘中国商品详情(废弃)
    public function taozg_detail(Request $request)
    {
        $data = $request->except(['_token']);

        if (!empty($data['id'])) {
            $detail = Db::table('goods_backydrop')->where(['good_id'=>$data['id']])->first();

            if (empty($detail)) {
                $detail = $this->get_goodsdetail($data['id']);
            } else {
                $detail = objtoarr($detail);
                $detail['data'] = json_decode($detail['content'], true);
            }

            $id = 0;
            $info = Db::table('goods_backydrop')->where(['good_id'=>$detail['data']['goodsId']])->first();
            $info = objtoarr($info);
            if (empty($info)) {
                $id = Db::table('goods_backydrop')->insertGetId([
                    'good_id'=>$detail['data']['goodsId'],
                    'content'=>json_encode($detail['data'], true)
                ]);
            } else {
                $id = $info['id'];
            }

            # 图片列表，每个图片都包含三张图片： 0-缩略图 1-大图 2-原图
            $arr['img'] = [];
            foreach ($detail['data']['mainItemImgs'] as $k=>$v) {
                for ($i=0;$i<3;$i++) {
                    $arr['img'][$k][$i] = $v;
                }
            }

            #商品规格（整合）
            $arr['sku'] = [];
            if (!empty($detail['data']['skuList'])) {
                $attr = [];
                foreach ($detail['data']['productProps'] as $k=>$v) {
                    if (empty($attr)) {
                        array_push($attr, [
                            'propId'=>$v['propId'],
                            'propName'=>$v['propName'],
                            'children'=>[]
                        ]);
                    } else {
                        if (!$this->isParamIn2DArray($v['propId'], $attr)) {
                            array_push($attr, [
                                'propId'=>$v['propId'],
                                'propName'=>$v['propName'],
                                'children'=>[]
                            ]);
                        }
                    }
                }

                foreach ($attr as $k=>$v) {
                    foreach ($detail['data']['productProps'] as $k2=>$v2) {
                        if ($v2['propId']==$v['propId']) {
                            array_push($attr[$k]['children'], [
                                'valueId'=>$v2['valueId'],
                                'valueName'=>$v2['valueName'],
                            ]);
                        }
                    }
                }
                $arr['sku'] = $attr;
            }

            $chat_log = Db::table('ssl_chat_content as a1')
                ->leftJoin('ssl_chat_object as a2', 'a1.pid', '=', 'a2.id')
                ->where(['a1.user_id'=>session('user')['user_id'],'a2.shopid'=>32])
                ->select('a1.content', 'a1.createtime', 'a1.id')
                ->get();
            $chat_log = objtoarr($chat_log);
            foreach ($chat_log as $k=>$v) {
                $chat_log[$k]['createtime'] = date('Y-m-d H:i', $v['createtime']);
            }

            #收货地址
            $address = [];
            if (!empty(session('user')['user_id'])) {
                $user = Db::table('user')->where(['user_id' => session('user')['user_id']])->first();
                $user2 = Db::connection('shop_db')->table('website_user')->where(['custom_id' => $user->gogo_id])->first();
                $address = Db::connection('shop_db')->table('centralize_user_address')->where(['user_id'=>$user2->id])->get();
                $address = objtoarr($address);
                if (!empty($address)) {
                    foreach ($address as $k=>$v) {
                        $address[$k]['country_id'] = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$v['country_id']])->first()->param2;
                        if (!empty($v['province'])) {
                            $address[$k]['province'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$v['province']])->first()->code_name;
                        }
                        if (!empty($v['city'])) {
                            $address[$k]['city'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id' => $v['city']])->first()->code_name;
                        }
                        if (!empty($v['area'])) {
                            $address[$k]['area'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id' => $v['area']])->first()->code_name;
                        }
                        $address[$k]['true_addr'] = $address[$k]['country_id'].$address[$k]['province'].$address[$k]['city'].$address[$k]['area'].$address[$k]['address1'];
                    }
                }
            }

            #获取配置信息
            $website = get_website();

            return view('func.taozg_detail', compact('detail', 'arr', 'id', 'chat_log', 'address', 'website'));
        }
    }

    #淘中国根据规格查看价格（废弃）
    public function taozg_getprice(Request $request)
    {
        $data = $request->except(['_token']);

        $goods = Db::table('goods_backydrop')->where(['id'=>$data['id']])->first();
        $goods = objtoarr($goods);
        $goods['content'] = json_decode($goods['content'], true);
        $price = '';
        $continue = 0;#1正确，0错误
        foreach ($goods['content']['skuList'] as $k=>$v) {
            foreach ($v['props'] as $k2=>$v2) {
                if (strpos($data['attr_ids'], (string)$v2['valueId']) !== false) {
                    $continue = 1;
                } else {
                    #错误
                    $continue = 0;
                    break;
                }
            }

            if ($continue==1) {
                $price = $v['price']['price'];
            }
        }
        return Response()->json(['code'=>0,'price'=>$price]);
    }

    #淘中国创建订单
    public function taozg_createorder(Request $request)
    {
        $data = $request->except(['_token']);

        $goods = Db::table('goods')->where(['goods_id'=>$data['data']['id']])->first();
        $goods = objtoarr($goods);

        #规格信息
//        $value_name = '';#规格名称
//        $attr_ids = explode(',',rtrim($data['data']['attr_ids'],','));
//        foreach($attr_ids as $k=>$v){
//            foreach($goods['content']['productProps'] as $k2 => $v2){
//                if($v == $v2['valueId']){
//                    $value_name .= $v2['propName'].':'.$v2['valueName'].'，';
//                }
//            }
//        }
//
//        $price = '';
//        $skucode = '';
//        $continue = 0;#1正确，0错误
//        foreach($goods['content']['skuList'] as $k=>$v){
//            foreach($v['props'] as $k2=>$v2){
//                if(strpos($data['data']['attr_ids'],(string)$v2['valueId']) !== false){
//                    $continue = 1;
//                }else{
//                    #错误
//                    $continue = 0;
//                    break;
//                }
//            }
//
//            if($continue==1){
//                $price = $v['price']['price'];
//                $skucode = $v['skuCode'];
//            }
//        }
//
//        if(empty($price)){
//            return response()->json(['code'=>-1,'msg'=>'订购失败，该商品规格暂时无货','data'=>[]]);
//        }

        $value_name = '';#规格名称
        $number = '';#规格购买数量
        $price = '';#规格单价
        $totalmoney = 0;#总金额
        $skucode = '';#规格的电商平台sku代码
        foreach ($data['data']['buy_attr'] as $k=>$v) {
            if ($goods['have_specs']==1) {
                #有规格
                $value_name .= $v['attr_name'].'@@@';
                $attr_id = str_replace('_', '|', $v['attr_id']);
                $number .= $v['buy_num'].'@@@';
                $sku = Db::table('goods_sku')->where(['goods_id'=>$data['data']['id'],'spec_vids'=>$attr_id])->first();
                $sku = objtoarr($sku);
                $sku['sku_prices'] = json_decode($sku['sku_prices'], true);
                $this_price = sprintf('%.2f', $sku['sku_prices']['price'][0] * $v['buy_num']);
                $price .= $this_price.'@@@';
                $totalmoney += $this_price;
                $skucode .= $sku['goods_sn'].'@@@';
            } elseif ($goods['have_specs']==2) {
                #无规格
                $number = $v['buy_num'];
                $sku = Db::table('goods_sku')->where(['goods_id'=>$data['data']['id']])->first();
                $sku = objtoarr($sku);
                $sku['sku_prices'] = json_decode($sku['sku_prices'], true);
                $this_price = sprintf('%.2f', $sku['sku_prices']['price'][0] * $v['buy_num']);
                $price = $this_price;
                $totalmoney += $this_price;
                $skucode = $sku['goods_sn'];
            }
        }

//        $totalmoney = number_format($price * $data['data']['number'],2,'.','');
        #业务服务
        $services = [];
        if (isset($data['data']['services_attr'])) {
            foreach ($data['data']['services_attr'] as $k=>$v) {
                $services = Db::table('goods_services')->where(['id'=>$v['service_id']])->first();
                $services = objtoarr($services);
                if ($v['service_id']==1) {
                    $data['data']['services_attr'][$k]['photoRequest'] = explode('@@@', rtrim($v['photoRequest'], '@@@'));
                    if ($v['photonum']>1) {
                        $totalmoney += $services['price'] + (($v['photonum'] - 1) * $services['interval_price']);
                    }
                } else {
                    $totalmoney += $services['price'];
                }
            }
            $services = $data['data']['services_attr'];
        }

        #1、创建商城订单
        DB::beginTransaction();
        try {
            $user = Db::table('user')->where(['user_id' => session('user')['user_id']])->first();
            $user2 = Db::connection('shop_db')->table('website_user')->where(['custom_id' => $user->gogo_id])->first();
            $time = time();
            $ordersn = 'GP' . date('YmdH', $time) . str_pad(
                mt_rand(1, 999999),
                6,
                '0',
                STR_PAD_LEFT
            ) . substr(microtime(), 2, 6);
            $orderid = Db::connection('shop_db')->table('website_order_list')->insertGetId([
                'user_id' => $user2->id,
                'ordersn' => $ordersn,
                'order_type' => 1,
                'pay_method' => 1,
                'true_money' => $totalmoney,
                'content' => json_encode(['address_id'=>$data['data']['address_id'],'good_id'=>$data['data']['id'],'good_num'=>$number,'good_price'=>$price,'value_name'=>$value_name,'skuCode'=>$skucode,'services'=>$services], true),
                'status' => -2,
                'origin_type' => 1,
                'createtime' => $time,
            ]);

            $system = Db::connection('shop_db')->table('centralize_system_notice')->where(['uid'=>0])->first();
            $system = objtoarr($system);

            $ordersn2 = 'GP' . date('YmdH', $time) . str_pad(
                mt_rand(1, 999999),
                6,
                '0',
                STR_PAD_LEFT
            ) . substr(microtime(), 2, 6);
            $collect_id = Db::connection('shop_db')->table('customs_collection')->insertGetId([
                'uniacid' => 3,
                'openid' => $user2->openid,
                'send_openid' => $system['account'],#到时候换老板的微信
                'ordersn' => $ordersn2,
                'trade_price' => $totalmoney,
                'trade_type' => 1,
                'order_type'=>1,
                'good_id' => $data['data']['id'],
                'payer_name' => !empty($user2->realname) ? $user2->realname : $user2->nickname,
                'payer_tel' => !empty($user2->phone) ? $user2->phone : '',
                'pay_term' => 0,
                'pay_fee' => 0,
                'overdue' => '',
                'overdue_money' => 0,
                'total_money' => $totalmoney,
                'trans_form' => 1,
                'status' => 0,
                'basic'=>2,
                'createtime' => $time,
                'orderno' => $ordersn,
                'orderurl' => 'https://www.gogo198.net/?s=index/tb_order_detail&id=' . $orderid
            ]);

            sleep(1);
            $res = Db::connection('shop_db')->table('website_order_list')->where(['id' => $orderid])->update([
                'pay_id' => $collect_id
            ]);

            if ($res) {
                #创建国内结算二维码
                $code_url = $this->create_code(1, $collect_id, $data['data']['id']);
                sleep(1);
                Db::connection('shop_db')->table('website_order_list')->where(['id' => $orderid])->update([
                    'code_url' => $code_url
                ]);

                #生成对方系统订单(需发去管理员，经管理员决定)
//                $res = $this->create_order(json_encode(['ordersn'=>$ordersn,'createtime'=>$time*1000,'platform'=>$goods['content']['platform'],'productCount'=>$data['data']['number'],'productLink'=>$goods['content']['goodsLink'],'productName'=>$goods['content']['goodsName'],'productPrice'=>$price,'skuCode'=>$skucode,'spuCode'=>$goods['content']['spuCode'],'productImage'=>$goods['content']['picUrl'],'orderRemark'=>'用户：'.$user->gogo_id],true));
//                if($res['code']==0){
//                    Db::connection('shop_db')->table('website_order_list')->where(['id'=>$orderid])->update([
//                        'other_ordersn'=>$res['data']['shopOrderNo']
//                    ]);
//                }
                shuntWechat([
                    'first'=>'商城订单['.$ordersn.']',
                    'keyword1'=>'商城订单['.$ordersn.']',
                    'keyword2'=>'申请订购',
                    'remark'=>'查看详情',
//                    'url'=>'https://www.gogo198.net/?s=shop/audit&id='.$orderid,
                    'url'=>'https://www.gogo198.net/?s=shop/audit',
                    'temp_id'=>'SVVs5OeD3FfsGwW0PEfYlZWetjScIT8kDxht5tlI1V8'
                ]);
                DB::commit();
                return response()->json(['code'=>0,'msg'=>'订购成功','data'=>['ordersn'=>$ordersn]]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            echo $e->getCode();
            return response()->json(['code'=>-1,'msg'=>'系统错误，请联系管理员']);
        }
    }

    #废弃
    public function taozg_createorder2(Request $request)
    {
        $data = $request->except(['_token']);
        $goods = Db::table('goods_backydrop')->where(['id'=>$data['data']['id']])->first();
        $goods = objtoarr($goods);
        $goods['content'] = json_decode($goods['content'], true);

        #规格信息
        $value_name = '';#规格名称
        $attr_ids = explode(',', rtrim($data['data']['attr_ids'], ','));
        foreach ($attr_ids as $k=>$v) {
            foreach ($goods['content']['productProps'] as $k2 => $v2) {
                if ($v == $v2['valueId']) {
                    $value_name .= $v2['propName'].':'.$v2['valueName'].'，';
                }
            }
        }

        $price = '';
        $skucode = '';
        $continue = 0;#1正确，0错误
        foreach ($goods['content']['skuList'] as $k=>$v) {
            foreach ($v['props'] as $k2=>$v2) {
                if (strpos($data['data']['attr_ids'], (string)$v2['valueId']) !== false) {
                    $continue = 1;
                } else {
                    #错误
                    $continue = 0;
                    break;
                }
            }

            if ($continue==1) {
                $price = $v['price']['price'];
                $skucode = $v['skuCode'];
            }
        }

        if (empty($price)) {
            return response()->json(['code'=>-1,'msg'=>'订购失败，该商品规格暂时无货','data'=>[]]);
        }

        $totalmoney = number_format($price * $data['data']['number'], 2, '.', '');

        #1、创建商城订单
        DB::beginTransaction();
        try {
            $user = Db::table('user')->where(['user_id' => session('user')['user_id']])->first();
            $user2 = Db::connection('shop_db')->table('website_user')->where(['custom_id' => $user->gogo_id])->first();
            $time = time();
            $ordersn = 'GP' . date('YmdH', $time) . str_pad(
                mt_rand(1, 999999),
                6,
                '0',
                STR_PAD_LEFT
            ) . substr(microtime(), 2, 6);
            $orderid = Db::connection('shop_db')->table('website_order_list')->insertGetId([
                'user_id' => $user2->id,
                'ordersn' => $ordersn,
                'order_type' => 1,
                'pay_method' => 1,
                'true_money' => $totalmoney,
                'content' => json_encode(['address_id'=>$data['data']['address_id'],'good_id'=>$data['data']['id'],'good_num'=>$data['data']['number'],'good_price'=>$price,'value_name'=>$value_name,'skuCode'=>$skucode], true),
                'status' => -2,
                'origin_type' => 1,
                'createtime' => $time,
            ]);

            $system = Db::connection('shop_db')->table('centralize_system_notice')->where(['uid'=>0])->first();
            $system = objtoarr($system);

            $ordersn2 = 'GP' . date('YmdH', $time) . str_pad(
                mt_rand(1, 999999),
                6,
                '0',
                STR_PAD_LEFT
            ) . substr(microtime(), 2, 6);
            $collect_id = Db::connection('shop_db')->table('customs_collection')->insertGetId([
                'uniacid' => 3,
                'openid' => $user2->openid,
                'send_openid' => $system['account'],#到时候换老板的微信
                'ordersn' => $ordersn2,
                'trade_price' => $totalmoney,
                'trade_type' => 1,
                'order_type'=>1,
                'good_id' => $data['data']['id'],
                'payer_name' => !empty($user2->realname) ? $user2->realname : $user2->nickname,
                'payer_tel' => !empty($user2->phone) ? $user2->phone : '',
                'pay_term' => 0,
                'pay_fee' => 0,
                'overdue' => '',
                'overdue_money' => 0,
                'total_money' => $totalmoney,
                'trans_form' => 1,
                'status' => 0,
                'basic'=>2,
                'createtime' => $time,
                'orderno' => $ordersn,
                'orderurl' => 'https://www.gogo198.net/?s=index/tb_order_detail&id=' . $orderid
            ]);

            sleep(1);
            $res = Db::connection('shop_db')->table('website_order_list')->where(['id' => $orderid])->update([
                'pay_id' => $collect_id
            ]);

            if ($res) {
                #创建国内结算二维码
                $code_url = $this->create_code(1, $collect_id, $data['data']['id']);
                sleep(1);
                Db::connection('shop_db')->table('website_order_list')->where(['id' => $orderid])->update([
                    'code_url' => $code_url
                ]);

                #生成对方系统订单(需发去管理员，经管理员决定)
//                $res = $this->create_order(json_encode(['ordersn'=>$ordersn,'createtime'=>$time*1000,'platform'=>$goods['content']['platform'],'productCount'=>$data['data']['number'],'productLink'=>$goods['content']['goodsLink'],'productName'=>$goods['content']['goodsName'],'productPrice'=>$price,'skuCode'=>$skucode,'spuCode'=>$goods['content']['spuCode'],'productImage'=>$goods['content']['picUrl'],'orderRemark'=>'用户：'.$user->gogo_id],true));
//                if($res['code']==0){
//                    Db::connection('shop_db')->table('website_order_list')->where(['id'=>$orderid])->update([
//                        'other_ordersn'=>$res['data']['shopOrderNo']
//                    ]);
//                }
                shuntWechat([
                    'first'=>'商城订单['.$ordersn.']',
                    'keyword1'=>'商城订单['.$ordersn.']',
                    'keyword2'=>'申请订购',
                    'remark'=>'查看详情',
//                    'url'=>'https://www.gogo198.net/?s=shop/audit&id='.$orderid,
                    'url'=>'https://www.gogo198.net/?s=shop/audit',
                    'temp_id'=>'SVVs5OeD3FfsGwW0PEfYlZWetjScIT8kDxht5tlI1V8'
                ]);
                DB::commit();
                return response()->json(['code'=>0,'msg'=>'订购成功','data'=>[]]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            echo $e->getCode();
            return response()->json(['code'=>-1,'msg'=>'系统错误，请联系管理员']);
        }
    }

    #废弃
    public function create_order_backup()
    {
        DB::beginTransaction();
        try {
            $user = Db::table('user')->where(['user_id' => session('user')['user_id']])->first();
            $user2 = Db::connection('shop_db')->table('website_user')->where(['custom_id' => $user->gogo_id])->first();
            $time = time();
            $ordersn = 'GP' . date('YmdH', $time) . str_pad(
                mt_rand(1, 999999),
                6,
                '0',
                STR_PAD_LEFT
            ) . substr(microtime(), 2, 6);
            $orderid = Db::connection('shop_db')->table('website_order_list')->insertGetId([
                'user_id' => $user2->id,
                'ordersn' => $ordersn,
                'order_type' => 1,
                'pay_method' => 1,
                'true_money' => $totalmoney,
                'content' => json_encode(['good_id'=>$data['data']['id'],'good_num'=>$data['data']['number'],'good_price'=>$price], true),
                'status' => -2,
                'origin_type' => 1,
                'createtime' => $time,
            ]);

            $system = Db::connection('shop_db')->table('centralize_system_notice')->where(['uid'=>0])->first();
            $system = objtoarr($system);

            $ordersn2 = 'GP' . date('YmdH', $time) . str_pad(
                mt_rand(1, 999999),
                6,
                '0',
                STR_PAD_LEFT
            ) . substr(microtime(), 2, 6);
            $collect_id = Db::connection('shop_db')->table('customs_collection')->insertGetId([
                'uniacid' => 3,
                'openid' => $user2->openid,
                'send_openid' => $system['account'],#到时候换老板的微信
                'ordersn' => $ordersn2,
                'trade_price' => $totalmoney,
                'trade_type' => 1,
                'order_type'=>1,
                'good_id' => $data['data']['id'],
                'payer_name' => !empty($user2->realname) ? $user2->realname : $user2->nickname,
                'payer_tel' => !empty($user2->phone) ? $user2->phone : '',
                'pay_term' => 0,
                'pay_fee' => 0,
                'overdue' => '',
                'overdue_money' => 0,
                'total_money' => $totalmoney,
                'trans_form' => 1,
                'status' => 0,
                'basic'=>2,
                'createtime' => $time,
                'orderno' => $ordersn,
                'orderurl' => 'https://www.gogo198.net/?s=index/tb_order_detail&id=' . $orderid
            ]);

            sleep(1);
            $res = Db::connection('shop_db')->table('website_order_list')->where(['id' => $orderid])->update([
                'pay_id' => $collect_id
            ]);

            if ($res) {
                #创建国内结算二维码
                $code_url = $this->create_code(1, $collect_id, $data['data']['id']);
                sleep(1);
                Db::connection('shop_db')->table('website_order_list')->where(['id' => $orderid])->update([
                    'code_url' => $code_url
                ]);

                #生成对方系统订单
                $res = $this->create_order(json_encode(['ordersn'=>$ordersn,'createtime'=>$time*1000,'platform'=>$goods['content']['platform'],'productCount'=>$data['data']['number'],'productLink'=>$goods['content']['goodsLink'],'productName'=>$goods['content']['goodsName'],'productPrice'=>$price,'skuCode'=>$skucode,'spuCode'=>$goods['content']['spuCode'],'productImage'=>$goods['content']['picUrl'],'orderRemark'=>'用户：'.$user->gogo_id], true));
                if ($res['code']==0) {
                    Db::connection('shop_db')->table('website_order_list')->where(['id'=>$orderid])->update([
                        'other_ordersn'=>$res['data']['shopOrderNo']
                    ]);
                }
                DB::commit();
                return response()->json(['code'=>0,'msg'=>'订购成功','data'=>[]]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            echo $e->getCode();
            return response()->json(['code'=>-1,'msg'=>'系统错误，请联系管理员']);
        }
    }

    #创建国内结算二维码
    public function create_code($type=0, $orderid=0, $good_id=0)
    {
        if ($type==1) {
            $url = 'https://shop.gogo198.cn/app/index.php?i=3&c=entry&do=member&p=custompayment&m=sz_yi&oid='.intval($orderid);
            #生成报价二维码
            $folder = $_SERVER['DOCUMENT_ROOT'].'/qrcode/pay_order_qrcode/';
            $name = 'order_'.session('user.user_id').'_'.$good_id;
            $img = $this->generate_code($name, $url, $folder);
            return $img;
        }
    }

    //生成二维码
    public function generate_code($name, $url, $folder)
    {
        //链接生成二维码
        $errorCorrectionLevel = 'L';//错误等级，忽略
        $matrixPointSize = 4;
//        require $_SERVER['DOCUMENT_ROOT'].'/qrcode/phpqrcode.php';
        require_once  __DIR__.'/phpqrcode.php';
        $path = $folder; //储存的地方
        if (!is_dir($path)) {
            mkdirs($path); //创建文件夹
        }

        $infourl = $url;
        $filename =  $path.$name.'.png'; //图片文件

        \QRcode::png($infourl, $filename, $errorCorrectionLevel, $matrixPointSize, 2); //生成图片

//        dd($infourl, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
//    $filename = str_replace('/www/wwwroot/gogo','https://shop.gogo198.cn',$filename);
        $logo = 'https://shop.gogo198.cn/collect_website/public/logo.png';//准备好的logo图片
        $QR = $filename;//已经生成的原始二维码图
        if ($logo !== false) {
            $QR = imagecreatefromstring(file_get_contents($QR));
            $logo = imagecreatefromstring(file_get_contents($logo));
            $QR_width = imagesx($QR);//二维码图片宽度
            $QR_height = imagesy($QR);//二维码图片高度
            $logo_width = imagesx($logo);//logo图片宽度
            $logo_height = imagesy($logo);//logo图片高度
            $logo_qr_width = $QR_width / 5; //logo图片在二维码图片中宽度大小
            $scale = $logo_width/$logo_qr_width;
            $logo_qr_height = $logo_height/$scale; //logo图片在二维码图片中高度大小
            $from_width = ($QR_width - $logo_qr_width) / 2;
            //重新组合图片并调整大小
            imagecopyresampled(
                $QR,
                $logo,
                $from_width,
                $from_width,
                0,
                0,
                $logo_qr_width,
                $logo_qr_height,
                $logo_width,
                $logo_height
            );
        }

        imagepng($QR, $filename); // 保存最终生成的二维码到本地

        //直接输出图片到浏览器
//        Header("Content-type: image/png");

        $qrcode = str_replace('/www/wwwroot/shopping.gogo198.cn/public', 'https://api.gogo198.cn', $filename);
        return $qrcode;
    }

    public function isParamIn2DArray($param, $array)
    {
        foreach ($array as $subArray) {
            if (in_array($param, $subArray)) {
                return true;
            }
        }
        return false;
    }

    #=========================================================
    //取消采购订单
    public function cancel_order(Request $request)
    {
        $dat = $request->except(['_token']);
        if (!empty($dat['partnerOrderNo'])) {
            $order = Db::connection('shop_db')->table('website_order_list')->where(['ordersn'=>$dat['partnerOrderNo']])->first();
            $order = objtoarr($order);
            $orderCode = '';
            if ($order['type']==2) {
                $orderCode = $this->getPocode($dat['partnerOrderNo']);
            }

            #请求取消订购
            $res = Db::connection('shop_db')->table('website_order_list')->where(['ordersn'=>$dat['partnerOrderNo']])->update([
                'other_ordersn'=>$orderCode,
                'status'=>-3
            ]);
            if ($res) {
                #申请取消订购（创建订单后取消订购对方待做，创建订单后付钱了才可取消）
                #通知管理员
                sendWechat([
                    'first'=>'商城订单['.$dat['partnerOrderNo'].']',
                    'keyword1'=>'商城订单['.$dat['partnerOrderNo'].']',
                    'keyword2'=>'申请取消订购',
                    'remark'=>'点击进入总后台',
                    'url'=>'https://gadmin.gogo198.cn',
                    'temp_id'=>'SVVs5OeD3FfsGwW0PEfYlZWetjScIT8kDxht5tlI1V8'
                ]);
                return Response()->json(['code'=>0,'msg'=>'提交申请成功']);
            }

//            $res = file_get_contents('https://shop.gogo198.cn/collect_website/public/?s=/api/getgoods/cancel_order&orderCode='.$orderCode);
//            $res = json_decode($res,true);
//            if($res['data']['success']==1){
//                $res = Db::connection('shop_db')->table('website_order_list')->where(['ordersn'=>$dat['partnerOrderNo']])->update([
//                    'other_ordersn'=>$orderCode,
//                    'status'=>-3
//                ]);
//                if($res){
//                    return Response()->json(['code'=>0]);
//                }else{
//                    return Response()->json(['code'=>-1]);
//                }
//            }
        }
    }

    //获取国内物流轨迹
    public function get_domestic_route(Request $request)
    {
        $dat = $request->except(['_token']);

        $orderCode = $this->getPocode($dat['partnerOrderNo']);
        $res = httpRequest('https://shop.gogo198.cn/collect_website/public/?s=/api/getgoods/domestic_route&poOrderCode='.$orderCode, [], []);
        $res = json_decode($res, true);
        if ($res['code']==0) {
            if (!empty($res['data']['originTraceInfo']['traceNodes'])) {
                foreach ($res['data']['originTraceInfo']['traceNodes'] as $k=>&$v) {
                    $v['recordTime'] = date('Y-m-d H:i:s', $v['recordTime'] / 1000);
                }
            }
            return Response()->json(['code'=>0,'data'=>$res['data']]);
        } elseif ($res['code']==-1) {
            return Response()->json(['code'=>-1,'msg'=>'暂无物流消息']);
        }
    }

    //申请退换货
    public function return_goods(Request $request)
    {
        $dat = $request->except(['_token']);

        $status = 0;
        if ($dat['applyType']==1) {
            $status=-5;
        } elseif ($dat['applyType']==2) {
            $status=-7;
        }

        $orderCode = $this->getPocode($dat['ordersn']);

        $order_detail = httpRequest('https://shop.gogo198.cn/collect_website/public/?s=/api/getgoods/get_orderdetail&partnerOrderNo='.$dat['ordersn'], [], []);
        $order_detail = json_decode($order_detail, true);
        $skuCode = $order_detail['data']['poOrderList'][0]['poOrderDetails'][0]['bdSkuCode'];

        $res = Db::connection('shop_db')->table('website_order_list')->where(['ordersn'=>$dat['ordersn']])->update([
            'return_content'=>json_encode([
                'applySource'=>$dat['applySource'],
                'orderCode'=>$orderCode,
                'applyType'=>$dat['applyType'],
                'applyContent'=>$dat['applyContent'],
                'skuCode'=>$skuCode,
                'quantity'=>intval($dat['quantity']),
            ], true),
            'status'=>$status
        ]);

        if ($res) {
            #通知管理员
            sendWechat([
                'first'=>'商城订单['.$dat['ordersn'].']',
                'keyword1'=>'商城订单['.$dat['ordersn'].']',
                'keyword2'=>'申请退换货',
                'remark'=>'点击进入总后台',
                'url'=>'https://gadmin.gogo198.cn',
                'temp_id'=>'SVVs5OeD3FfsGwW0PEfYlZWetjScIT8kDxht5tlI1V8'
            ]);
            return Response()->json(['code'=>0,'msg'=>'提交申请成功']);
        }
    }

    #=========================================================

    //获取采购单ordersn
    public function getPocode($partnerOrderNo='')
    {
        $orderCode = '';
        $ishave = Db::connection('shop_db')->table('website_order_list')->where(['ordersn'=>$partnerOrderNo])->first();
        if (empty($ishave->other_posn)) {
            #请求第三方平台的订单详情，获得po采购单编号
            $res = httpRequest('https://shop.gogo198.cn/collect_website/public/?s=/api/getgoods/get_orderdetail&partnerOrderNo='.$partnerOrderNo, [], []);
            $order_detail = json_decode($res, true);
            $orderCode = $order_detail['data']['poOrderList'][0]['orderCode'];
            Db::connection('shop_db')->table('website_order_list')->where(['ordersn'=>$partnerOrderNo])->update([
                'other_posn'=>$orderCode
            ]);
        } else {
            $orderCode = $ishave->other_posn;
        }

        return $orderCode;
    }

    #系统没有此商品，请求接口
    public function get_goods($catename)
    {
        $res = httpRequest('https://shop.gogo198.cn/collect_website/public/?s=/api/getgoods/keyword_query&keyword='.$catename, [], []);
        $res = json_decode($res, true);
        return $res;
    }

    #商品详情
    public function get_goodsdetail($id)
    {
        $res = httpRequest('https://shop.gogo198.cn/collect_website/public/?s=/api/getgoods/detail_query&type=1&good_id='.$id, [], []);
        $res = json_decode($res, true);
        return $res;
    }

    #生成订单
    public function create_order($data)
    {
        $res = httpRequest2('https://shop.gogo198.cn/collect_website/public/?s=/api/getgoods/create_order', $data, ['Content-Type: application/json;charset=utf-8']);
        $res = json_decode($res, true);
        return $res;
    }

    #检查该分类有无商品
    public function check_goods(Request $request)
    {
        $data = $request->except(['_token']);

        $g = Db::table('goods')->where(['cat_id'=>$data['cat_id']])->first();
        $g = objtoarr($g);
        if (!empty($g)) {
            return Response()->json(['code'=>1]);
        } else {
            return Response()->json(['code'=>0]);
        }
    }

    #品牌馆
    public function brand_stree(Request $request)
    {
        $data = $request->except(['_token']);

        //品牌表
        $brand = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['pid'=>8])->orderBy('id', 'asc')->get();
        $brand = objtoarr($brand);

        foreach ($brand as $k=>$v) {
            $brand[$k]['goods_num'] = Db::table('goods')->where(['brand_id'=>$v['id']])->count();
        }

        $sort = array_column($brand, 'goods_num');
        array_multisort($sort, SORT_DESC, $brand);

        return view('func.brand_stree', compact('brand'));
    }

    #获取信息
    public function gettableinfo(Request $request)
    {
        $data = $request->except(['_token']);
        $id = intval($data['id']);
        $res = '';
        if ($id==1) {
            if (session('country_list') == '') {
                $res = httpRequest('https://shop.gogo198.cn/collect_website/public/?s=api/gather/gettableinfo', ['id' => $id,'no_need'=>162]);
                $res2 = json_decode($res, true);
                $res = $res2['list'];
                session('country_list', $res);
                $request->session()->put('country_list', $res);
            } else {
                $res = session('country_list');
            }
        }

        return Response()->json(['code'=>0,'list'=>$res]);
    }

    #获取历史价格
    public function get_history_price(Request $request)
    {
        $data = $request->except(['_token']);
        $id = intval($data['id']);

        $list = Db::table('goods_price_history')->where(['goods_id'=>$id])->orderBy('id', 'desc')->get();
        $list = objtoarr($list);

        if (empty($list)) {
            return Response()->json(['code'=>-1,'msg'=>'暂无历史价格']);
        } else {
            foreach ($list as $k=>$v) {
                $list[$k]['createtime'] = date('Y年m月d日', $v['createtime']);
                if ($v['sort_type']==1) {
                    $list[$k]['sort_type_name'] = '降价↓';
                } elseif ($v['sort_type']==2) {
                    $list[$k]['sort_type_name'] = '升价↑';
                }
            }
            return Response()->json(['code'=>0,'msg'=>'','list'=>$list]);
        }
    }

    #获取当前国地信息+邮政编码
    public function getphonenum(Request $request)
    {
        $data = $request->except(['_token']);
        if ($data['pa']==1) {
            // $area = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$data['id']])->first();
            #1、按照国家获取手机号
            $phone = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$data['id']])->first();
            $phone = objtoarr($phone);
            #2、按照国家获取邮政编码
            $post = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['pid'=>4,'param1'=>$phone['param5']])->first();
            $post = objtoarr($post);
            $post_temp = '';
            if (!empty($post)) {
                $post_temp = $post['param3'];
            }

            #按照国家获取省
//            $province = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['country_id'=>$data['id'],'pid'=>0])->get();
//            $province = objtoarr($province);

            #按照国家获取邮政编码
//            ." and code_name REGEXP '^[^A-Za-z\x{4e00}-\x{9fa5}]+$'"
            $regex = '[0-9]';
            $postal = Db::connection('shop_db')->table('centralize_adminstrative_area')->where([['country_id','=',$data['id']],['code_name','regexp',$regex],['code_name', 'not regexp', '[()]']])->limit(1000)->get();
            $postal = objtoarr($postal);

            return Response()->json(['code'=>0,'phone'=>$phone['param8'],'post'=>$post_temp,'province'=>[],'postal'=>$postal]);
        } elseif ($data['pa']==2) {
            $city = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['pid'=>$data['id']])->get();
            $city = objtoarr($city);
            return Response()->json(['code'=>0,'area'=>$city]);
        } elseif ($data['pa']==3) {
            #根据邮政编码，获取所有的省市区...
            $postal = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$data['id']])->first();
            $postal = objtoarr($postal);
            $areas = [];
            $area1 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$postal['pid']])->first();
            $area1 = objtoarr($area1);
            if (!empty($area1['pid'])) {
                $area2 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$area1['pid']])->first();
                $area2 = objtoarr($area2);
                if (!empty($area2['pid'])) {
                    $area3 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$area2['pid']])->first();
                    $area3 = objtoarr($area3);
                    if (!empty($area3['pid'])) {
                        $area4 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$area3['pid']])->first();
                        $area4 = objtoarr($area4);

                        if (empty($area4['pid'])) {
                            $areas = [$area4['code_name'],$area3['code_name'],$area2['code_name'],$area1['code_name']];
                        }
                    } else {
                        $areas = [$area3['code_name'],$area2['code_name'],$area1['code_name']];
                    }
                } else {
                    $areas = [$area2['code_name'],$area1['code_name']];
                }
            } else {
                $areas = [$area1['code_name']];
            }

            return Response()->json(['code'=>0,'areas'=>$areas]);
        }
    }

    #获取模糊搜索的邮政编码
    public function getpostal(Request $request)
    {
        $data = $request->except(['_token']);

        $regex = '[0-9]';
        $postal = Db::connection('shop_db')->table('centralize_adminstrative_area')->where([['country_id','=',$data['country']],['code_name','regexp',$regex],['code_name', 'not regexp', '[()]'],['code_name','like','%'.trim($data['keywords']).'%']])->limit(1000)->get();
        $postal = objtoarr($postal);

        return Response()->json(['code'=>0,'results'=>$postal]);
    }

    #地址START==============================================
    #地址列表
    public function address_list(Request $request)
    {
        $dat = $request->except(['_token']);
        $isframe = isset($dat['isframe']) ? intval($dat['isframe']) : 0;
        $uid = isset($dat['uid']) ? base64_decode($dat['uid']) : 0;

        #自动登录
        if (empty(session('user')) && !empty($uid)) {
            $user2 = Db::connection('shop_db')->table('website_user')->where(['id'=>$uid])->first();
            $user = Db::table('user')->where(['gogo_id'=>$user2->custom_id])->first();
            $user = objtoarr($user);
            $request->session()->put('user', $user);
        }

        if (isset($dat['pa'])) {
            $limit = $dat['limit'];
            $page = $dat['page'] - 1;

            if ($page != 0) {
                $page = $limit * $page;
            }
            $user = Db::connection('shop_db')->table('website_user')->where(['custom_id'=>session('user')['gogo_id']])->first();
            $count = Db::connection('shop_db')->table('centralize_user_address')->where(['user_id'=>$user->id])->count();
            $rows = DB::connection('shop_db')->table('centralize_user_address')
                ->where(['user_id'=>$user->id])
                ->offset($page)
                ->limit($limit)
                ->orderBy('id', 'desc')
                ->get();
            $rows = objtoarr($rows);

            foreach ($rows as $k=>$v) {
//                $rows[$k]['createtime'] = date('Y-m-d H:i',$v['createtime']);
                #地区
                $rows[$k]['detail_area'] = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$v['country_id']])->first()->param2;
                $province = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$v['province']])->first()->code_name;
                $rows[$k]['detail_area'] .= ' '.$province;
                if (!empty($v['city'])) {
                    $city = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$v['city']])->first()->code_name;
                    $rows[$k]['detail_area'] .= ' '.$city;
                }
                if (!empty($v['area'])) {
                    $area = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$v['area']])->first()->code_name;
                    $rows[$k]['detail_area'] .= ' '.$area;
                }
                if (!empty($v['area2'])) {
                    $area2 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$v['area2']])->first()->code_name;
                    $rows[$k]['detail_area'] .= ' '.$area2;
                }
                if (!empty($v['area3'])) {
                    $area3 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$v['area3']])->first()->code_name;
                    $rows[$k]['detail_area'] .= ' '.$area3;
                }
                if (!empty($v['area4'])) {
                    $area4 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$v['area4']])->first()->code_name;
                    $rows[$k]['detail_area'] .= ' '.$area4;
                }
                #地址
                $rows[$k]['detail_address'] = $v['address1'];
                #邮政编码
                $rows[$k]['postal'] = implode("", json_decode($v['postal_code'], true));
                #手机/电话
                $rows[$k]['mobile'] = $v['mobile'].'/'.$v['mobile2'];
            }
            return Response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
        } else {
            #获取配置信息
            $website = get_website();
            $page_info = get_pageinfo('/address_list');
            $website['background'] = $page_info['content']['background'];
            $website['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];

            return view('func.address_list', compact('website', 'isframe'));
        }
    }

    #保存地址
    public function save_address(Request $request)
    {
        $data = $request->except(['_token']);
        $isframe = isset($data['isframe']) ? intval($data['isframe']) : 0;
        $id = isset($data['id']) ? intval($data['id']) : 0;
        if ($id==0) {
            $id = isset($data['id']) ? intval($data['id']) : 0;
        }
        if ($request->isMethod('post')) {
            if (!empty(session('user'))) {
//                print_r($data);die;
                $user = Db::connection('shop_db')->table('website_user')->where(['custom_id' => session('user')['gogo_id']])->first();
                $name = trim($data['user_name1']) . ' ' . trim($data['user_name2']) . ' ' . trim($data['user_name3']);

                #详细地址（最多3个）
                $address2 = [];
                if (isset($data['address2'])) {
                    foreach ($data['address2'] as $k=>$v) {
                        array_push($address2, $v);
                    }
                }

                #邮政编码（废弃）
                $post = [];

                #新的邮政编码
                $postal = '0';
                $province = '0';
                $city = '0';
                $area = '0';
                $area2 = '0';
                $area3 = '0';
                $area4 = '0';
                if ($data['postal'] != '自定义') {
                    #有数据，获取id
//                    $area_code = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['country_id'=>$data['country'],'code_name'=>$data['postal']])->first();
                    $postal = $data['postal'];


                    if (isset($data['diycountry'][0])) {
                        $area_code = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['country_id'=>$data['country'],'code_name'=>$data['diycountry'][0]])->first();
                        $province = $area_code->id;
                    }
                    if (isset($data['diycountry'][1])) {
                        $area_code = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['country_id'=>$data['country'],'code_name'=>$data['diycountry'][1]])->first();
                        $city = $area_code->id;
                    }
                    if (isset($data['diycountry'][2])) {
                        $area_code = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['country_id'=>$data['country'],'code_name'=>$data['diycountry'][2]])->first();
                        $area = $area_code->id;
                    }
                    if (isset($data['diycountry'][3])) {
                        $area_code = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['country_id'=>$data['country'],'code_name'=>$data['diycountry'][3]])->first();
                        $area2 = $area_code->id;
                    }
                    if (isset($data['diycountry'][4])) {
                        $area_code = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['country_id'=>$data['country'],'code_name'=>$data['diycountry'][4]])->first();
                        $area3 = $area_code->id;
                    }
                    if (isset($data['diycountry'][5])) {
                        $area_code = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['country_id'=>$data['country'],'code_name'=>$data['diycountry'][5]])->first();
                        $area4 = $area_code->id;
                    }
                } else {
                    #无数据。自行生成邮政编码，遵从表格格式，省->市->区->区2->区3->镇->邮编
                    if (isset($data['diycountry'][1])) {
                        #区域1
                        if (empty($data['diycountry'][1])) {
                            return Response()->json(['code'=>-1,'msg'=>'请输入行政区域']);
                        }
                        $ishave = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['country_id'=>$data['country'],'code_name'=>$data['diycountry'][1]])->first();
                        if (empty($ishave)) {
                            $code_id = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                'country_id'=>$data['country'],
                                'pid'=>0,
                                'code_name'=>$data['diycountry'][1]
                            ]);
                            $province = $code_id;
                        } else {
                            $province = $ishave->id;
                        }
                    } else {
                        return Response()->json(['code'=>-1,'msg'=>'请输入至少一个行政区域']);
                    }

                    if (isset($data['diycountry'][2])) {
                        #区域2
                        $ishave = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['country_id' => $data['country'], 'code_name' => $data['diycountry'][2]])->first();
                        if (empty($ishave)) {
                            $code_id = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                'country_id' => $data['country'],
                                'pid' => $province,
                                'code_name' => $data['diycountry'][2]
                            ]);
                            $city = $code_id;
                        } else {
                            $city = $ishave->id;
                        }
                    }

                    if (isset($data['diycountry'][3])) {
                        #区域3
                        $ishave = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['country_id' => $data['country'], 'code_name' => $data['diycountry'][3]])->first();
                        if (empty($ishave)) {
                            $code_id = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                'country_id' => $data['country'],
                                'pid' => $city,
                                'code_name' => $data['diycountry'][3]
                            ]);
                            $area = $code_id;
                        } else {
                            $area = $ishave->id;
                        }
                    }

                    if (isset($data['diycountry'][4])) {
                        #区域4
                        $ishave = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['country_id' => $data['country'], 'code_name' => $data['diycountry'][4]])->first();
                        if (empty($ishave)) {
                            $code_id = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                'country_id' => $data['country'],
                                'pid' => $area,
                                'code_name' => $data['diycountry'][4]
                            ]);
                            $area2 = $code_id;
                        } else {
                            $area2 = $ishave->id;
                        }
                    }

                    if (isset($data['diycountry'][5])) {
                        #区域5
                        $ishave = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['country_id' => $data['country'], 'code_name' => $data['diycountry'][5]])->first();
                        if (empty($ishave)) {
                            $code_id = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                'country_id' => $data['country'],
                                'pid' => $area2,
                                'code_name' => $data['diycountry'][5]
                            ]);
                            $area3 = $code_id;
                        } else {
                            $area3 = $ishave->id;
                        }
                    }

                    if (isset($data['diycountry'][6])) {
                        #区域6
                        $ishave = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['country_id' => $data['country'], 'code_name' => $data['diycountry'][6]])->first();
                        if (empty($ishave)) {
                            $code_id = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                'country_id' => $data['country'],
                                'pid' => $area3,
                                'code_name' => $data['diycountry'][6]
                            ]);
                            $area4 = $code_id;
                        } else {
                            $area4 = $ishave->id;
                        }
                    }

                    if (isset($data['diycountry'][0])) {
                        #邮政编码
                        if (empty($data['diycountry'][0])) {
                            return Response()->json(['code'=>-1,'msg'=>'请输入邮政编码']);
                        }
                        $ishave = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['country_id'=>$data['country'],'code_name'=>$data['diycountry'][0]])->first();
                        if (empty($ishave)) {
                            $pid = 0;
                            if (!empty($area4)) {
                                $pid = $area4;
                            } elseif (!empty($area3)) {
                                $pid = $area3;
                            } elseif (!empty($area2)) {
                                $pid = $area2;
                            } elseif (!empty($area)) {
                                $pid = $area;
                            } elseif (!empty($city)) {
                                $pid = $city;
                            } elseif (!empty($province)) {
                                $pid = $province;
                            }

                            $code_id = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                'country_id'=>$data['country'],
                                'pid'=>$pid,
                                'code_name'=>$data['diycountry'][0]
                            ]);
                            $postal = $code_id;
                        } else {
                            $postal = $ishave->id;
                        }
                    } else {
                        return Response()->json(['code'=>-1,'msg'=>'请输入邮政编码']);
                    }
                }

                if (isset($data['is_default'])) {
                    if ($data['is_default'] == 1) {
                        Db::connection('shop_db')->table('centralize_user_address')->whereRaw('user_id=' . $user->id . ' and is_default=1')->update(['is_default' => 0]);
                    }
                }

                if ($id>0) {
                    $res = Db::connection('shop_db')->table('centralize_user_address')->where(['user_id'=>$user->id,'id'=>$id])->update([
                        'user_name' => $name,
                        'mobile' => trim($data['mobile']),
                        'mobile2' => trim($data['mobile2']),
                        'email' => trim($data['email']),
                        'address1' => trim($data['address1']),
                        'address2' => json_encode($address2, true),
                        'is_default' => isset($data['is_default']) ? $data['is_default'] : 0,
                    ]);
                } else {
                    $res = Db::connection('shop_db')->table('centralize_user_address')->insert([
                        'user_id' => $user->id,
                        'country_id' => $data['country'],
                        'postal'=>$postal,
                        'province' => $province,
                        'city' => $city,
                        'area' => $area,
                        'area2' => $area2,
                        'area3' => $area3,
                        'area4' => $area4,
                        'user_name' => $name,
                        'area_mobile' => trim($data['area_mobile']),
                        'mobile' => trim($data['mobile']),
                        'mobile2' => trim($data['mobile2']),
                        'email' => trim($data['email']),
                        'postal_code' => json_encode($post, true),#废弃
                        'address1' => trim($data['address1']),
                        'address2' => json_encode($address2, true),
                        'createtime' => time(),
                        'is_default' => isset($data['is_default']) ? $data['is_default'] : 0,
                    ]);
                }

                if ($res) {
                    return Response()->json(['code' => 0, 'msg' => '保存成功']);
                }
            }
        } else {
            #获取配置信息
            $website = get_website();
            $page_info = get_pageinfo('/address_list');
            $website['background'] = $page_info['content']['background'];
            $website['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];

            $country = Db::connection('shop_db')->table('centralize_diycountry_content')->whereRaw('pid=5 and id<>162')->get();
            $country = objtoarr($country);

            #收货地址
            $address = ['country_id'=>'','province'=>'','city'=>'','area'=>'','area2'=>'','area3'=>'','area4'=>'','area_mobile'=>'','mobile'=>'','mobile2'=>'','address1'=>'','address2'=>[],'email'=>'','postal_code'=>'','user_name'=>['','',''],'is_default'=>0];
            if ($id>0) {
                $address = Db::connection('shop_db')->table('centralize_user_address')->where(['id'=>$id])->first();
                $address = objtoarr($address);

                #收货国地--start
                $address['detail_area'] = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$address['country_id']])->first()->param2;
                $province = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['province']])->first()->code_name;
                $address['detail_area'] .= ' '.$province;
                if (!empty($address['city'])) {
                    $city = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['city']])->first()->code_name;
                    $address['detail_area'] .= ' '.$city;
                }
                if (!empty($address['area'])) {
                    $area = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['area']])->first()->code_name;
                    $address['detail_area'] .= ' '.$area;
                }
                if (!empty($address['area2'])) {
                    $area2 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['area2']])->first()->code_name;
                    $address['detail_area'] .= ' '.$area2;
                }
                if (!empty($address['area3'])) {
                    $area3 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['area3']])->first()->code_name;
                    $address['detail_area'] .= ' '.$area3;
                }
                if (!empty($v['area4'])) {
                    $area4 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['area4']])->first()->code_name;
                    $address['detail_area'] .= ' '.$area4;
                }
                #收货国地--end

                #收货人姓名
                $address['user_name'] = explode(' ', $address['user_name']);
                if (count($address['user_name'])==2) {
                    $uname2 = $address['user_name'][1];
                    $address['user_name'][1] = '';
                    $address['user_name'][2] = $uname2;
                }

                #邮政编码
                $address['postal_code'] = implode("", json_decode($address['postal_code'], true));

                #更多收货地址
                if (!empty($address['address2'])) {
                    $address['address2'] = json_decode($address['address2'], true);
                }
            }


            return view('func.save_address', compact('website', 'isframe', 'address', 'country', 'id'));
        }
    }

    public function save_address_backup(Request $request)
    {
        $data = $request->except(['_token']);
        $isframe = isset($data['isframe']) ? intval($data['isframe']) : 0;
        $id = isset($data['id']) ? intval($data['id']) : 0;
        if ($id==0) {
            $id = isset($data['data']['id']) ? intval($data['data']['id']) : 0;
        }
        if ($request->isMethod('post')) {
            if (!empty(session('user'))) {
                print_r($data);
                die;
                $user = Db::connection('shop_db')->table('website_user')->where(['custom_id' => session('user')['gogo_id']])->first();
                $name = trim($data['data']['user_name1']) . ' ' . trim($data['data']['user_name2']) . ' ' . trim($data['data']['user_name3']);

                $address2 = [];
                for ($i = 0; $i < 9; $i++) {
                    if (isset($data['data']['address2[' . $i])) {
                        array_push($address2, $data['data']['address2[' . $i]);
                    }
                }

                $post = [];
                for ($i = 0; $i < 9; $i++) {
                    if (isset($data['data']['postal_code[' . $i])) {
                        array_push($post, $data['data']['postal_code[' . $i]);
                    }
                }

                $province = '0';
                if (isset($data['data']['province'])) {
                    $province = $data['data']['province'];
                }

                $city = '0';
                if (isset($data['data']['city'])) {
                    $city = $data['data']['city'];
                }

                $area = '0';
                if (isset($data['data']['area'])) {
                    $area = $data['data']['area'];
                }
                $area2 = '0';
                if (isset($data['data']['area2'])) {
                    $area2 = $data['data']['area2'];
                }
                $area3 = '0';
                if (isset($data['data']['area3'])) {
                    $area3 = $data['data']['area3'];
                }
                $area4 = '0';
                if (isset($data['data']['area4'])) {
                    $area4 = $data['data']['area4'];
                }

                if ($province == '自定义') {
                    $total_area = [];
                    for ($i = 0; $i < 6; $i++) {
                        if (isset($data['data']['diycountry[' . $i])) {
                            array_push($total_area, $data['data']['diycountry[' . $i]);
                        }
                    }
                    if (!empty($total_area)) {
                        $pid = 0;
                        foreach ($total_area as $k => $v) {
                            $pid = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                'country_id' => $data['data']['country'],
                                'pid' => $pid,
                                'code_name' => trim($v)
                            ]);
                            if ($k == 0) {
                                $province = $pid;
                            } elseif ($k == 1) {
                                $city = $pid;
                            } elseif ($k == 2) {
                                $area = $pid;
                            } elseif ($k == 3) {
                                $area2 = $pid;
                            } elseif ($k == 4) {
                                $area3 = $pid;
                            } elseif ($k == 5) {
                                $area4 = $pid;
                            }
                        }
                    }
                } else {
                    if ($city == '自定义') {
                        $total_area = [];
                        for ($i = 0; $i < 5; $i++) {
                            if (isset($data['data']['diycountry[' . $i])) {
                                array_push($total_area, $data['data']['diycountry[' . $i]);
                            }
                        }
                        if (!empty($total_area)) {
                            $pid = $province;
                            foreach ($total_area as $k => $v) {
                                $pid = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                    'country_id' => $data['data']['country'],
                                    'pid' => $pid,
                                    'code_name' => trim($v)
                                ]);
                                if ($k == 0) {
                                    $city = $pid;
                                } elseif ($k == 1) {
                                    $area = $pid;
                                } elseif ($k == 2) {
                                    $area2 = $pid;
                                } elseif ($k == 3) {
                                    $area3 = $pid;
                                } elseif ($k == 4) {
                                    $area4 = $pid;
                                }
                            }
                        }
                    } else {
                        if ($area == '自定义') {
                            $total_area = [];
                            for ($i = 0; $i < 4; $i++) {
                                if (isset($data['data']['diycountry[' . $i])) {
                                    array_push($total_area, $data['data']['diycountry[' . $i]);
                                }
                            }
                            if (!empty($total_area)) {
                                $pid = $city;
                                foreach ($total_area as $k => $v) {
                                    $pid = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                        'country_id' => $data['data']['country'],
                                        'pid' => $pid,
                                        'code_name' => trim($v)
                                    ]);
                                    if ($k == 0) {
                                        $area = $pid;
                                    } elseif ($k == 1) {
                                        $area2 = $pid;
                                    } elseif ($k == 2) {
                                        $area3 = $pid;
                                    } elseif ($k == 3) {
                                        $area4 = $pid;
                                    }
                                }
                            }
                        } else {
                            if ($area2 == '自定义') {
                                $total_area = [];
                                for ($i = 0; $i < 3; $i++) {
                                    if (isset($data['data']['diycountry[' . $i])) {
                                        array_push($total_area, $data['data']['diycountry[' . $i]);
                                    }
                                }
                                if (!empty($total_area)) {
                                    $pid = $area;
                                    foreach ($total_area as $k => $v) {
                                        $pid = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                            'country_id' => $data['data']['country'],
                                            'pid' => $pid,
                                            'code_name' => trim($v)
                                        ]);
                                        if ($k == 0) {
                                            $area2 = $pid;
                                        } elseif ($k == 2) {
                                            $area3 = $pid;
                                        } elseif ($k == 3) {
                                            $area4 = $pid;
                                        }
                                    }
                                }
                            } else {
                                if ($area3 == '自定义') {
                                    $total_area = [];
                                    for ($i = 0; $i < 2; $i++) {
                                        if (isset($data['data']['diycountry[' . $i])) {
                                            array_push($total_area, $data['data']['diycountry[' . $i]);
                                        }
                                    }
                                    if (!empty($total_area)) {
                                        $pid = $area;
                                        foreach ($total_area as $k => $v) {
                                            $pid = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                                'country_id' => $data['data']['country'],
                                                'pid' => $pid,
                                                'code_name' => trim($v)
                                            ]);
                                            if ($k == 0) {
                                                $area3 = $pid;
                                            } elseif ($k == 1) {
                                                $area4 = $pid;
                                            }
                                        }
                                    }
                                } else {
                                    if ($area4 == '自定义') {
                                        $total_area = [];
                                        for ($i = 0; $i < 1; $i++) {
                                            if (isset($data['data']['diycountry[' . $i])) {
                                                array_push($total_area, $data['data']['diycountry[' . $i]);
                                            }
                                        }
                                        if (!empty($total_area)) {
                                            $pid = $area;
                                            foreach ($total_area as $k => $v) {
                                                $pid = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                                    'country_id' => $data['data']['country'],
                                                    'pid' => $pid,
                                                    'code_name' => trim($v)
                                                ]);
                                                if ($k == 0) {
                                                    $area4 = $pid;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                if ($data['data']['is_default'] == 1) {
                    Db::connection('shop_db')->table('centralize_user_address')->whereRaw('user_id=' . $user->id . ' and is_default=1')->update(['is_default' => 0]);
                }

                if ($id>0) {
                    $res = Db::connection('shop_db')->table('centralize_user_address')->where(['user_id'=>$user->id,'id'=>$id])->update([
                        'user_name' => $name,
                        'mobile' => trim($data['data']['mobile']),
                        'mobile2' => trim($data['data']['mobile2']),
                        'email' => $data['data']['email'],
                        'address1' => $data['data']['address1'],
                        'address2' => json_encode($address2, true),
                        'is_default' => $data['data']['is_default'],
                    ]);
                } else {
                    $res = Db::connection('shop_db')->table('centralize_user_address')->insert([
                        'user_id' => $user->id,
                        'country_id' => $data['data']['country'],
                        'province' => $province,
                        'city' => $city,
                        'area' => $area,
                        'area2' => $area2,
                        'area3' => $area3,
                        'area4' => $area4,
                        'user_name' => $name,
                        'area_mobile' => trim($data['data']['area_mobile']),
                        'mobile' => trim($data['data']['mobile']),
                        'mobile2' => trim($data['data']['mobile2']),
                        'email' => $data['data']['email'],
                        'postal_code' => json_encode($post, true),
                        'address1' => $data['data']['address1'],
                        'createtime' => time(),
                        'address2' => json_encode($address2, true),
                        'is_default' => $data['data']['is_default'],
                    ]);
                }


                if ($res) {
                    return Response()->json(['code' => 0, 'msg' => '保存成功']);
                }
            }
        } else {
            #获取配置信息
            $website = get_website();
            $page_info = get_pageinfo('/address_list');
            $website['background'] = $page_info['content']['background'];
            $website['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];

            $country = Db::connection('shop_db')->table('centralize_diycountry_content')->whereRaw('pid=5 and id<>162')->get();
            $country = objtoarr($country);

            #收货地址
            $address = ['country_id'=>'','province'=>'','city'=>'','area'=>'','area2'=>'','area3'=>'','area4'=>'','area_mobile'=>'','mobile'=>'','mobile2'=>'','address1'=>'','address2'=>[],'email'=>'','postal_code'=>'','user_name'=>['','',''],'is_default'=>0];
            if ($id>0) {
                $address = Db::connection('shop_db')->table('centralize_user_address')->where(['id'=>$id])->first();
                $address = objtoarr($address);

                #收货国地--start
                $address['detail_area'] = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$address['country_id']])->first()->param2;
                $province = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['province']])->first()->code_name;
                $address['detail_area'] .= ' '.$province;
                if (!empty($address['city'])) {
                    $city = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['city']])->first()->code_name;
                    $address['detail_area'] .= ' '.$city;
                }
                if (!empty($address['area'])) {
                    $area = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['area']])->first()->code_name;
                    $address['detail_area'] .= ' '.$area;
                }
                if (!empty($address['area2'])) {
                    $area2 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['area2']])->first()->code_name;
                    $address['detail_area'] .= ' '.$area2;
                }
                if (!empty($address['area3'])) {
                    $area3 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['area3']])->first()->code_name;
                    $address['detail_area'] .= ' '.$area3;
                }
                if (!empty($v['area4'])) {
                    $area4 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['area4']])->first()->code_name;
                    $address['detail_area'] .= ' '.$area4;
                }
                #收货国地--end

                #收货人姓名
                $address['user_name'] = explode(' ', $address['user_name']);
                if (count($address['user_name'])==2) {
                    $uname2 = $address['user_name'][1];
                    $address['user_name'][1] = '';
                    $address['user_name'][2] = $uname2;
                }

                #邮政编码
                $address['postal_code'] = implode("", json_decode($address['postal_code'], true));

                #更多收货地址
                if (!empty($address['address2'])) {
                    $address['address2'] = json_decode($address['address2'], true);
                }
            }


            return view('func.save_address', compact('website', 'isframe', 'address', 'country', 'id'));
        }
    }

    #删除地址
    public function del_address(Request $request)
    {
        $data = $request->except(['_token']);
        $id = intval($data['id']);

        $res = Db::connection('shop_db')->table('centralize_user_address')->where(['id'=>$id])->delete();
        if ($res) {
            return Response()->json(['code'=>0,'msg'=>'删除成功']);
        }
    }
    #地址END================================================

    #发送验证码
    public function sendcode(Request $request)
    {
        $dat = $request->except(['_token']);

        $number = trim($dat['number']);
        $code = mt_rand(111111, 999999);

        if ($dat['method']==2) {
            $post_data = [
                'mobiles'=>$number,
                'content'=>$dat['msg'].$code.' 【GOGO】',
            ];
            $post_data = json_encode($post_data, true);
            $res = httpRequest('https://decl.gogo198.cn/api/sendmsg_jumeng', $post_data, [
                'Content-Type: application/json; charset=utf-8',
                'Content-Length:' . strlen($post_data),
                'Cache-Control: no-cache',
                'Pragma: no-cache'
            ]);// 必须声明请求头);
        } elseif ($dat['method']==1) {
            // 发送验证码
            $text = $dat['msg'].$code;
            $post_data = json_encode(['email'=>$number,'title'=>'淘中国','content'=>$text], true);
            $res = httpRequest('https://shop.gogo198.cn/collect_website/public/?s=api/sendemail/index', $post_data, [
                'Content-Type: application/json; charset=utf-8',
                'Content-Length:' . strlen($post_data),
                'Cache-Control: no-cache',
                'Pragma: no-cache'
            ]);
        }

        if (!$res) {
            return Response()->json(['code' => -1, 'msg' => '发送失败']);
        }

        // 设置session
        $request->session()->put($dat['code_name'], $code);

        return Response()->json(['code' => 0, 'msg' => '发送成功']);
    }

    #提交验证-验证码
    public function check_verifyCode_for_rules(Request $request)
    {
        $dat = $request->except(['_token']);
        if (empty($dat['sure_code'])) {
            return Response()->json(['code'=>-1,'msg'=>'验证码错误']);
        }
        if (session('sure_code') == trim($dat['sure_code'])) {
//            unset($_SESSION['think']['sure_code']);
            Session::forget('think.sure_code');
            return Response()->json(['code'=>0,'msg'=>'验证成功']);
        } else {
            return Response()->json(['code'=>-1,'msg'=>'验证码错误']);
        }
    }

    public function getLanguage(Request $request)
    {
        $dat = $request->except(['_token']);

        return Response()->json([
            'info'=>'成功',
            'result'=>1,
            'list'=>[
                ["id"=> "chinese_simplified","name"=> "简体中文"],
                ["id"=> "chinese_traditional","name"=> "繁體中文"],
                ["id"=> "english","name"=> "English"],
                ["id"=> "japanese","name"=> "日本語"],
                ["id"=> "german","name"=> "Deutsch"],
                ["id"=> "corsican","name"=> "Corsu"],
                ["id"=> "guarani","name"=> "guarani"],
                ["id"=> "hausa","name"=> "Hausa"],
                ["id"=> "welsh","name"=> "Cymraeg"],
                ["id"=> "gongen","name"=> "गोंगेन हें नांव"],
                ["id"=> "aymara","name"=> "Aymara"],
                ["id"=> "french","name"=> "Français"],
                ["id"=> "haitian_creole","name"=> "Kreyòl ayisyen"],
                ["id"=> "czech","name"=> "čeština"],
                ["id"=> "hawaiian","name"=> "ʻŌlelo Hawaiʻi"],
                ["id"=> "dogrid","name"=> "डोग्रिड ने दी"],
                ["id"=> "russian","name"=> "Русский язык"],
                ["id"=> "thai","name"=> "ภาษาไทย"],
                ["id"=> "armenian","name"=> "հայերեն"],
                ["id"=> "persian","name"=> "فارسی"],
                ["id"=> "hmong","name"=> "Hmoob"],
                ["id"=> "dhivehi","name"=> "ދިވެހި"],
                ["id"=> "bhojpuri","name"=> "भोजपुरी"],
                ["id"=> "turkish","name"=> "Türkçe"],
                ["id"=> "hindi","name"=> "हिंदी"],
                ["id"=> "belarusian","name"=> "беларускі"],
                ["id"=> "bulgarian","name"=> "български"],
                ["id"=> "twi","name"=> "tur"],
                ["id"=> "irish","name"=> "Gaeilge"],
                ["id"=> "gujarati","name"=> "ગુજરાતી"],
                ["id"=> "hungarian","name"=> "Magyar"],
                ["id"=> "estonian","name"=> "eesti keel"],
                ["id"=> "arabic","name"=> "بالعربية"],
                ["id"=> "bengali","name"=> "বাংলা"],
                ["id"=> "azerbaijani","name"=> "Azərbaycan"],
                ["id"=> "portuguese","name"=> "Português"],
                ["id"=> "Cebuano","name"=> "Cebuano"],
                ["id"=> "afrikaans","name"=> "Suid-Afrikaanse Dutch taal"],
                ["id"=> "kurdish_sorani","name"=> "کوردی-سۆرانی"],
                ["id"=> "greek","name"=> "Ελληνικά"],
                ["id"=> "spanish","name"=> "español"],
                ["id"=> "frisian","name"=> "Frysk"],
                ["id"=> "danish","name"=> "dansk"],
                ["id"=> "amharic","name"=> "አማርኛ"],
                ["id"=> "bambara","name"=> "Bamanankan"],
                ["id"=> "basque","name"=> "euskara"],
                ["id"=> "vietnamese","name"=> "Tiếng Việt"],
                ["id"=> "korean","name"=> "한어"],
                ["id"=> "assamese","name"=> "অসমীয়া"],
                ["id"=> "catalan","name"=> "català"],
                ["id"=> "finnish","name"=> "Suomalainen"],
                ["id"=> "ewe","name"=> "Eʋegbe"],
                ["id"=> "croatian","name"=> "Hrvatski"],
                ["id"=> "scottish-gaelic","name"=> "Gàidhlig na h-Alba"],
                ["id"=> "bosnian","name"=> "bosanski"],
                ["id"=> "galician","name"=> "galego"],
            ]
        ]);
    }
}
