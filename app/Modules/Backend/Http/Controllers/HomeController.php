<?php

#2024-12-23 增加商户配置站点信息后，在前端获取并写样式

namespace App\Modules\Backend\Http\Controllers;

use App\Modules\Base\Http\Controllers\Backend2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class HomeController extends Backend2
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

    public function home(Request $request)
    {
        #获取滚动信息
        $this->websites['rotate_info'] = Db::connection('shop_db')->table('merchsite_rotate')->where(['company_id'=>$this->websites['cid']])->first();
        $this->websites['rotate_info'] = objtoarr($this->websites['rotate_info']);
        if (!empty($this->websites['rotate_info']['content_id'])) {
            $this->websites['rotate_info']['content_id'] = explode(',', $this->websites['rotate_info']['content_id']);
            foreach ($this->websites['rotate_info']['content_id'] as $k=>$v) {
                if ($v==1) {
                    #新闻内容
                    $news = Db::connection('shop_db')->table('website_crossborder_news')->where(['time'=>date('Y-m-d')])->inRandomOrder()->limit(50)->get();
                    if (count($news)==0) {
                        $news = Db::connection('shop_db')->table('website_crossborder_news')->where(['status'=>1])->inRandomOrder()->limit(50)->get();
                    }
                    $this->websites['rotate_info']['content'][$k] = objtoarr($news);
                } elseif ($v==2) {
                    #时间内容
                    $citys = Db::connection('shop_db')->table('website_world_time')->where(['is_show'=>0])->orderBy('displayorder', 'asc')->get()->groupBy('contryCn');
                    $this->websites['rotate_info']['content'][$k] = objtoarr($citys);
                } elseif ($v==3) {
                    #汇率内容
                    $rate = Db::connection('shop_db')->table('website_exchange_rate')->whereRaw('id != 158 ')->get();
                    $rate = objtoarr($rate);

                    #其他币种
                    $currency = Db::connection('shop_db')->table('centralize_currency')->whereRaw('code_zhname <> "人民币元"')->get();
                    $currency = objtoarr($currency);
                    $this->websites['rotate_info']['content'][$k] = ['rate'=>$rate,'currency'=>$currency];
                }
            }
        }

        #获取轮播图
        $this->websites['rotate'] = Db::connection('shop_db')->table('website_rotate')->where(['company_id'=>$this->websites['cid']])->get();
        $this->websites['rotate'] = objtoarr($this->websites['rotate']);

        #获取首页推荐A
        $this->websites['recommendA'] = Db::connection('shop_db')->table('website_discovery_list')->where(['company_id'=>$this->websites['cid']])->get();
        $this->websites['recommendA'] = objtoarr($this->websites['recommendA']);

        #获取首页推荐B
        $this->websites['recommendB'] = Db::connection('shop_db')->table('merchsite_recommend_b')->where(['company_id'=>$this->websites['cid']])->get();
        $this->websites['recommendB'] = objtoarr($this->websites['recommendB']);
        foreach ($this->websites['recommendB'] as $k=>$v) {
            $this->websites['recommendB'][$k]['children'] = [];
            if ($v['go_other']==2) {
                #商品详情，按倒序获取该企业商品
                $this->websites['recommendB'][$k]['children'] = Db::table('goods')->where(['shop_id'=>$this->websites['cid'],'goods_status'=>1])->orderBy('goods_id', 'desc')->get();
                $this->websites['recommendB'][$k]['children'] = objtoarr($this->websites['recommendB'][$k]['children']);
                foreach ($this->websites['recommendB'][$k]['children'] as $k2=>$v2) {
                    $sku_prices = Db::table('goods_sku')->where(['sku_id'=>$v2['sku_id']])->first()->sku_prices;
                    $sku_prices = json_decode($sku_prices, true);
                    if ($v2['goods_price']==0) {
                        $this->websites['recommendB'][$k]['children'][$k2]['goods_price'] = number_format(end($sku_prices['price']), 2);
                    }
                    $this->websites['recommendB'][$k]['children'][$k2]['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$sku_prices['currency'][0]])->first()->currency_symbol_standard;
                }
            }
        }

        #获取导流区
        $this->websites['guide'] = Db::table('merchsite_guide_body')->where(['company_id'=>$this->websites['cid']])->get();
        $this->websites['guide'] = objtoarr($this->websites['guide']);

        foreach ($this->websites['guide'] as $k=>$v) {
            #导流样式
            $this->websites['guide'][$k]['format_info'] = Db::table('merchsite_guide_format')->where(['id'=>$v['content_id']])->first();
            $this->websites['guide'][$k]['format_info'] = objtoarr($this->websites['guide'][$k]['format_info']);
            #获取导流内容
            if ($this->websites['guide'][$k]['format_info']['type']==1 || $this->websites['guide'][$k]['format_info']['type']==3 || $this->websites['guide'][$k]['format_info']['type']==5) {
                #店铺展示/触发搜索/图文展示版式
                $this->websites['guide'][$k]['children'] = Db::table('guide_content')->where(['pid'=>$v['id'],'company_id'=>$this->websites['cid']])->get();
                $this->websites['guide'][$k]['children'] = objtoarr($this->websites['guide'][$k]['children']);

                #商家上架信息==start
                $shelf_info = Db::table('goods_shelf')->whereRaw('cid='.$this->websites['cid'].' and type=1 and guide_id='.$v['id'].' and keywords <> ""')->get();
                $shelf_info = objtoarr($shelf_info);
                foreach ($shelf_info as $k2=>$v2) {
                    $arr1 = explode('、', $v2['keywords']);
                    $arr2 = explode('、', $v['gkeywords']);

                    $intersection = array_intersect($arr1, $arr2);

                    if (!empty($intersection)) {
                        #有当前导流关键字的商品
                        $goods = Db::table('goods')->where(['goods_id'=>$v2['gid'],'goods_status'=>1])->first();
                        $goods = objtoarr($goods);

                        if (!empty($goods)) {
                            $keywords_content = [
                                'name' => $goods['goods_name'],
                                'back_type' => 2,
                                'back_content' => str_replace('//rte.gogo198.cn', '', $goods['goods_image']),
                                'back_content2' => str_replace('//rte.gogo198.cn', '', $goods['goods_image']),
                                'go_other' => 2,
                                'other_goods' => $goods['goods_id'],
                            ];
                            $this->websites['guide'][$k]['children'] = array_merge($this->websites['guide'][$k]['children'], [$keywords_content]);
                        }
                    }
                }
                #商家上架信息==end

                foreach ($this->websites['guide'][$k]['children'] as $k2=>$v2) {
                    if ($v2['go_other']==2) {
                        #商品
                        $this->websites['guide'][$k]['children'][$k2]['info'] = Db::table('goods')->where(['goods_id'=>$v2['other_goods'],'goods_status'=>1])->first();
                        $this->websites['guide'][$k]['children'][$k2]['info'] = objtoarr($this->websites['guide'][$k]['children'][$k2]['info']);

                        $sku_prices = Db::table('goods_sku')->where(['sku_id'=>$this->websites['guide'][$k]['children'][$k2]['info']['sku_id']])->first()->sku_prices;
                        $sku_prices = json_decode($sku_prices, true);
                        if ($this->websites['guide'][$k]['children'][$k2]['info']['goods_price']==0) {
                            $this->websites['guide'][$k]['children'][$k2]['info']['goods_price'] = number_format(end($sku_prices['price']), 2);
                        }
                        $this->websites['guide'][$k]['children'][$k2]['info']['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$sku_prices['currency'][0]])->first()->currency_symbol_standard;
                    }
                }

                shuffle($this->websites['guide'][$k]['children']);

                if ($this->websites['guide'][$k]['format_info']['type']==3) {
                    //触发搜索
                    if (is_mobile2()) {
                        $this->websites['guide'][$k]['children'] = array_chunk($this->websites['guide'][$k]['children'], 1);
                    } else {
                        $this->websites['guide'][$k]['children'] = array_chunk($this->websites['guide'][$k]['children'], 6);
                    }

                    foreach ($this->websites['guide'][$k]['children'] as $k2=>$v2) {
                        if (is_mobile2()) {
                            $this->websites['guide'][$k]['children'][$k2] = array_chunk($v2, 1);
                        } else {
                            $this->websites['guide'][$k]['children'][$k2] = array_chunk($v2, 3);
                        }
                    }
                }
            } elseif ($this->websites['guide'][$k]['format_info']['type']==2) {
                #卡片导航版式
                $this->websites['guide'][$k]['children'] = Db::table('guide_content')->where(['pid'=>$v['id'],'top_id'=>0,'company_id'=>$this->websites['cid']])->get();
                $this->websites['guide'][$k]['children'] = objtoarr($this->websites['guide'][$k]['children']);
                foreach ($this->websites['guide'][$k]['children'] as $k2=>$v2) {
                    $this->websites['guide'][$k]['children'][$k2]['children'] = Db::table('guide_content')->where(['pid'=>$v['id'],'top_id'=>$v2['id'],'company_id'=>$this->websites['cid']])->get();
                    $this->websites['guide'][$k]['children'][$k2]['children'] = objtoarr($this->websites['guide'][$k]['children'][$k2]['children']);
                }
            } elseif ($this->websites['guide'][$k]['format_info']['type']==4) {
                #杂志导航版式
                $this->websites['guide'][$k]['big_children'] = Db::table('guide_content')->where(['top_id'=>0,'pid'=>$v['id'],'company_id'=>$this->websites['cid'],'is_show'=>0])->get();
                $this->websites['guide'][$k]['big_children'] = objtoarr($this->websites['guide'][$k]['big_children']);
                foreach ($this->websites['guide'][$k]['big_children'] as $k2=>$v2) {
                    $this->websites['guide'][$k]['big_children'][$k2]['sml_children'] = Db::table('guide_content')->where(['pid'=>$v['id'],'top_id'=>$v2['id'],'company_id'=>$this->websites['cid']])->get();
                    $this->websites['guide'][$k]['big_children'][$k2]['sml_children'] = objtoarr($this->websites['guide'][$k]['big_children'][$k2]['sml_children']);

                    if (is_mobile2()) {
                        $this->websites['guide'][$k]['big_children'][$k2]['sml_children'] = array_chunk($this->websites['guide'][$k]['big_children'][$k2]['sml_children'], 4);
                    } else {
                        $this->websites['guide'][$k]['big_children'][$k2]['sml_children'] = array_chunk($this->websites['guide'][$k]['big_children'][$k2]['sml_children'], 4);
                    }
                    foreach ($this->websites['guide'][$k]['big_children'][$k2]['sml_children'] as $k3=>$v3) {
                        foreach ($v3 as $k4=>$v4) {
                            $color = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['pid' => 12])->inRandomOrder()->first();
                            $color = objtoarr($color);
                            $this->websites['guide'][$k]['big_children'][$k2]['sml_children'][$k3][$k4]['rand_background'] = sprintf("#%02x%02x%02x", $color['param1'], $color['param2'], $color['param3']);
                        }
                    }
                }
            }
        }

        $data['websites'] = $this->websites;
        $data['source_link'] = $this->source_link;
        $data['page_type'] = 1;
//        dd($this->websites);
        return view('home.home', compact('data'));
    }

    #汇率详情
    public function rate_detail(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = isset($dat['id']) ? intval($dat['id']) : 0;
        $isframe = isset($dat['isframe']) ? intval($dat['isframe']) : 0;
        $price = isset($dat['price']) ? intval($dat['price']) : 1;

        if ($request->isMethod('post')) {
            if ($dat['pa']==1) {
                $key = 'feea63fb96c064f252418348bf775fa9';
                $from = Db::connection('shop_db')->table('website_exchange_rate')->where(['id'=>$dat['from_currency']])->first();
                $to = Db::connection('shop_db')->table('website_exchange_rate')->where(['id'=>$dat['to_currency']])->first();
                $url = 'http://api.tanshuapi.com/api/exchange/v1/index?key='.$key.'&from='.$from->symbol.'&to='.$to->symbol.'&money='.intval($dat['from_money']);
                $list = json_decode(file_get_contents($url), true);

                if ($list['code']==1) {
                    return Response()->json(['code'=>0,'msg'=>'查询成功','data'=>$list['data']]);
                } else {
                    return Response()->json(['code'=>-1,'msg'=>'查询失败']);
                }
            }
        } else {
            $rate = Db::connection('shop_db')->table('website_exchange_rate')->where(['id'=>$id])->first();
            $rate = objtoarr($rate);

            #币种
            $currency = Db::connection('shop_db')->table('website_exchange_rate')->whereRaw('id != 158 ')->get();
            $currency = objtoarr($currency);

            $origin_page = '/';
            $data['websites'] = $this->websites;
            $data['source_link'] = $this->source_link;

            return view('home.rate_detail', compact('data', 'id', 'rate', 'currency', 'isframe', 'price', 'origin_page'));
        }
    }

    #平台规则列表
    public function rule_list(Request $request)
    {
        $dat = $request->except(['_token']);
        if ($request->isMethod('post')) {
            $limit = $dat['limit'];
            $page = $dat['page'] - 1;

            if ($page != 0) {
                $page = $limit * $page;
            }
            $count = Db::connection('shop_db')->table('website_platform_keywords')->orderBy('id', 'desc')->count();
            $rows = DB::connection('shop_db')->table('website_platform_keywords as a')
                ->leftJoin('website_platform_type as b', 'b.id', '=', 'a.type_id')
                ->limit($page.','.$limit)
                ->orderBy('id', 'desc')
                ->select(['a.*','b.name as type_name'])
                ->get();
            $rows = objtoarr($rows);
            foreach ($rows as $k=>$v) {
                $rows[$k]['name'] = $v['type_name'].'['.$v['name'].']';
            }
            return Response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
        } else {
            $list = Db::connection('shop_db')->table('website_platform_type')->get();
            $list = objtoarr($list);
            foreach ($list as $k=>$v) {
                $list[$k]['children'] = Db::connection('shop_db')->table('website_platform_keywords')->where(['type_id'=>$v['id']])->get();
                $list[$k]['children'] = objtoarr($list[$k]['children']);
                foreach ($list[$k]['children'] as $k2=>$v2) {
                    $list[$k]['children'][$k2]['children'] = Db::connection('shop_db')->table('website_platform_rule')->where(['type_id'=>$v['id'],'key_id'=>$v2['id'],'pid'=>0])->get();
                    $list[$k]['children'][$k2]['children'] = objtoarr($list[$k]['children'][$k2]['children']);
                }
            }

            $origin_page = '/rule_list';

            #获取配置信息
            $data['websites'] = $this->websites;
            $data['source_link'] = $this->source_link;

            return view('home.rule_list', compact('data', 'list', 'page_info', 'origin_page'));
        }
    }

    #规则版本列表
    public function version_list(Request $request)
    {
        $dat = $request->except(['_token']);
        $pid = isset($dat['pid']) ? intval($dat['pid']) : 0;
        if (isset($dat['pa'])) {
            $limit = $dat['limit'];
            $page = $dat['page'] - 1;

            if ($page != 0) {
                $page = $limit * $page;
            }
            $count = Db::connection('shop_db')->table('website_platform_rule')->where(['pid'=>$pid,'status'=>0])->orWhere('id', '=', $pid)->count();
            $rows = DB::connection('shop_db')->table('website_platform_rule')
                ->where(['pid'=>$pid,'status'=>0])
                ->orWhere('id', '=', $pid)
                ->offset($page)
                ->limit($limit)
                ->orderBy('createtime', 'desc')
                ->get();
            $rows = objtoarr($rows);

            foreach ($rows as $k=>$v) {
                $rows[$k]['createtime'] = date('Y-m-d H:i', $v['createtime']);
            }
            return Response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
        } else {
            $history = Db::connection('shop_db')->table('website_platform_rule')->where(['id'=>$pid])->first();
            $history = objtoarr($history);

            #获取配置信息
            $data['websites'] = $this->websites;
            $data['source_link'] = $this->source_link;

            $origin_page = '/version_list?pid='.$pid;

            return view('home.version_list', compact('data', 'pid', 'page_info', 'history', 'origin_page'));
        }
    }

    #平台规则详情
    public function rule_detail(Request $request)
    {
        $dat = $request->except(['_token']);
        $foid = isset($dat['foid']) ? intval($dat['foid']) : 0;
        if ($request->isMethod('post')) {
            $data = Db::connection('shop_db')->table('website_platform_rule')->where(['id'=>$dat['id']])->find();
            $data = objtoarr($data);
            $data['content'] = json_decode($data['content'], true);
            $content = [];
            $first = [];
            $second = [];
            foreach ($data['content'] as $k=>$v) {
                if ($v['pnum']==$dat['parag_num']) {
                    array_push($first, [
                        'title'=>$v['title'],
                        'parag_num'=>$v['parag_num'],
                        'pnum'=>$v['pnum'],
                        'content'=>$v['content'],
                        'children'=>[],
                    ]);
                } else {
                    array_push($second, [
                        'title'=>$v['title'],
                        'parag_num'=>$v['parag_num'],
                        'pnum'=>$v['pnum'],
                        'content'=>$v['content'],
                        'children'=>[],
                    ]);
                }
            }

            #最多嵌套3层
            foreach ($first as $k=>$v) {
                foreach ($second as $k2=>$v2) {
                    if ($v['parag_num']==$v2['pnum']) {
                        #1.1.
                        array_push($first[$k]['children'], $v2);
                    } else {
                        foreach ($first[$k]['children'] as $k3=>$v3) {
                            if ($v3['parag_num']==$v2['pnum']) {
                                #1.1.1.
                                array_push($first[$k]['children'][$k3]['children'], [
                                    'title'=>$v2['title'],
                                    'parag_num'=>$v2['parag_num'],
                                    'pnum'=>$v2['pnum'],
                                    'content'=>$v2['content'],
                                    'children'=>[],
                                ]);
                            }
                        }
                    }
                }
            }
            $content = $first;
            return Response()->json(['code'=>0,'data'=>$content]);
        } else {
            #获取配置信息
            $data['websites'] = $this->websites;
            $data['source_link'] = $this->source_link;

            #规则内容
            $rule = Db::connection('shop_db')->table('website_platform_rule')->where(['id'=>$dat['id']])->first();
            $rule = objtoarr($rule);

            #分享
            $rule['url'] = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
            $rule['desc'] = $rule['version'];
            $rule['name'] = $rule['rule_name'];
            $rule['url_this'] = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
            $signPackage = weixin_share($rule);

            #序言
            if ($rule['is_preamble']==1) {
                $rule['preamble_con'] = json_decode($rule['preamble_con'], true);
            }
            $rule['content'] = json_decode($rule['content'], true);
            #整理树形结构代码
            if ($rule['type']==1) {
                $first = [];
                $second = [];
                foreach ($rule['content'] as $k=>$v) {
                    if ($v['pnum']==0) {
                        array_push($first, [
                            'title'=>$v['title'],
                            'parag_num'=>$v['parag_num'],
                            'pnum'=>$v['pnum'],
                            'content'=>$v['content'],
                            'children'=>[],
                        ]);
                    } else {
                        array_push($second, [
                            'title'=>$v['title'],
                            'parag_num'=>$v['parag_num'],
                            'pnum'=>$v['pnum'],
                            'content'=>$v['content'],
                            'children'=>[],
                        ]);
                    }
                }

                #最多嵌套3层
                foreach ($first as $k=>$v) {
                    foreach ($second as $k2=>$v2) {
                        if ($v['parag_num']==$v2['pnum']) {
                            #1.1.
                            array_push($first[$k]['children'], $v2);
                        } else {
                            foreach ($first[$k]['children'] as $k3=>$v3) {
                                if ($v3['parag_num']==$v2['pnum']) {
                                    #1.1.1.
                                    array_push($first[$k]['children'][$k3]['children'], [
                                        'title'=>$v2['title'],
                                        'parag_num'=>$v2['parag_num'],
                                        'pnum'=>$v2['pnum'],
                                        'content'=>$v2['content'],
                                        'children'=>[],
                                    ]);
                                }
                            }
                        }
                    }
                }
                $rule['content2'] = $first;
            }

            $origin_page = '/rule_detail?id='.$dat['id'].'&foid='.$foid;

            #是否有配置跳转其他应用
            $footerInfo = Db::table('footer_body')->where(['id'=>$foid])->first();
            $footerInfo = objtoarr($footerInfo);
            if (isset($footerInfo['have_link'])) {
                $footerInfo['link'] = $this->getAppLink(2, ['other_navbar'=>$footerInfo['content_id']]);
            }

            return view('home.rule_detail', compact('rule', 'data', 'signPackage', 'page_info', 'footerInfo', 'origin_page'));
        }
    }

    #菜单详情
    public function detail(Request $request)
    {
        $dat = $request->except(['_token']);
        $is_footer = isset($dat['is_footer']) ? intval($dat['is_footer']) : 0;
        $id = isset($dat['id']) ? intval($dat['id']) : 0;

        if ($id==0) {
            echo '<h1>缺少ID</h1><script>setTimeout(function(){ window.location.href="/"; },1000);</script>';
            exit;
        }
        $data = [];
        if ($is_footer==1) {
            #页脚菜单
            $data = Db::connection('shop_db')->table('website_footer')->where(['id'=>$id])->first();
            $data = objtoarr($data);
        } else {
            #页头菜单
            $data = Db::connection('shop_db')->table('website_navbar')->where(['id'=>$id])->first();
            $data = objtoarr($data);
        }

        #内页seo优化
        if ($data['seo_type']==2) {
            $data['seo_content'] = json_decode($data['seo_content'], true);
            $this->websites['info']['name'] = $data['seo_content']['title'];
            $this->websites['info']['keywords'] = $data['seo_content']['keywords'];
            $this->websites['info']['desc'] = $data['seo_content']['desc'];
        }

        $data['content'] = json_decode($data['content'], true);
        $data['websites'] = $this->websites;
        $data['source_link'] = $this->source_link;

        $origin_page = '/detail?id='.$id;

        return view('home.detail', compact('data', 'origin_page', 'id'));
    }

    #我要咨询
    public function advice(Request $request)
    {
        $dat = $request->except(['_token']);

        if ($dat['code_origin'] != trim($dat['code_input'])) {
            return Response()->json(['code'=>-1,'msg'=>'验证码不正确']);
        }

        if (empty($dat['name']) || empty($dat['email']) || empty($dat['mobile']) || empty($dat['content'])) {
            return Response()->json(['code'=>-1,'msg'=>'请输入信息']);
        }

        if (!preg_match("/^1[34578]\d{9}$/", trim($dat['mobile']))) {
            return Response()->json(['code'=>-1,'msg'=>'请输入正确的手机号码']);
        }

        if (!preg_match('/([\w\-]+\@[\w\-]+\.[\w\-]+)/', trim($dat['email']))) {
            return Response()->json(['code'=>-1,'msg'=>'请输入正确的邮箱号码']);
        }

        $res = Db::connection('shop_db')->table('website_message')->insert([
            'name'=>trim($dat['name']),
            'email'=>trim($dat['email']),
            'tel'=>trim($dat['mobile']),
            'remark'=>$dat['content'],
            'createtime'=>time(),
        ]);
        if ($res) {
            return Response()->json(['code'=>0,'msg'=>'提交成功！']);
        } else {
            return Response()->json(['code'=>-1,'msg'=>'提交失败！']);
        }
    }

    #关注我们详情
    public function social_detail(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = isset($dat['id']) ? intval($dat['id']) : 0;
        $isframe = isset($dat['isframe']) ? intval($dat['isframe']) : 0;
        $origin_page = '/social_detail?id='.$id;

        if ($request->isMethod('post')) {
        } else {
            #获取配置信息
            $data = ['websites'=>$this->websites,'source_link'=>$this->source_link];

            $info = Db::connection('shop_db')->table('website_contact')->where(['company_id'=>$this->websites['cid'],'id'=>$id])->first();
            $info = objtoarr($info);

            return view('home.social_detail', compact('data', 'id', 'info', 'isframe', 'origin_page'));
        }
    }

    #资质详情
    public function qualific(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = isset($dat['id']) ? intval($dat['id']) : 0;
        $isframe = isset($dat['isframe']) ? intval($dat['isframe']) : 0;
        $origin_page = '/qualific?id='.$id;

        if ($request->isMethod('post')) {
        } else {
            #获取配置信息
            $data = ['websites'=>$this->websites,'source_link'=>$this->source_link];

            $info = Db::connection('shop_db')->table('merchsite_qualification')->where(['company_id'=>$this->websites['cid'],'id'=>$id])->first();
            $info = objtoarr($info);

            return view('home.qualific', compact('data', 'id', 'info', 'isframe', 'origin_page'));
        }
    }

    #获取弹框内容
    public function getFrame(Request $request)
    {
        $data = $request->except(['_token']);
        $id = intval($data['id']);
        $type = intval($data['type']);

        if ($type==0) {
            $list = Db::table('frame_body')->where(['pid'=>$id])->get();
            $list = objtoarr($list);

            return Response()->json(['code'=>0,'list'=>$list]);
        } elseif ($type==99) {
            #提示框图片
            $adv = Db::table('frame_adv')->where(['id'=>$id])->first();
            $adv = objtoarr($adv);

            return Response()->json(['code'=>0,'adv'=>$adv]);
        } else {
            $list = Db::table('frame_body')->where(['type'=>$type,'pid'=>0,'id'=>$id])->orderBy('displayorder', 'asc')->get();
            $list = objtoarr($list);
            foreach ($list as $k=>$v) {
                if ($v['id']==$id) {
                    $list[$k]['children'] = Db::table('frame_body')->where(['pid'=>$id])->get();
                    $list[$k]['children'] = objtoarr($list[$k]['children']);
                    foreach ($list[$k]['children'] as $k2=>$v2) {
                        $list[$k]['children'][$k2]['link'] = $this->getAppLink(2, ['other_navbar'=>$v2['app_id']]);
                        if (strpos($list[$k]['children'][$k2]['link'], '?') !== false) {
                            $list[$k]['children'][$k2]['link'] .= '&isframe=1';
                        } else {
                            $list[$k]['children'][$k2]['link'] .= '?isframe=1';
                        }
                    }
                }

                if ($v['id']==11) {
                    #社交平台（获取后台配置的社交平台数据）
                    $list[$k]['children'] = Db::connection('shop_db')->table('website_contact')->where(['system_id'=>3])->get();
                    $list[$k]['children'] = objtoarr($list[$k]['children']);
                    foreach ($list[$k]['children'] as $k2=>$v2) {
                        if ($v2['type']==2) {
                            $list[$k]['children'][$k2]['link'] = '/social_detail?id='.$v2['id'].'&isframe=1';
                        }
                    }
                }

                if ($v['id']==21) {
                    #搜索中心（获取后台配置的搜索管理数据）
                    $list[$k]['children'] = Db::table('search_list')->get();
                    $list[$k]['children'] = objtoarr($list[$k]['children']);
                    foreach ($list[$k]['children'] as $k2=>$v2) {
                        $list[$k]['children'][$k2]['link'] = '/search_list?id='.$v2['id'].'&isframe=1';
                    }
                }
            }
            $adv = Db::table('frame_adv')->where(['type'=>$type])->first();
            $adv = objtoarr($adv);

            return Response()->json(['code'=>0,'list'=>$list,'adv'=>$adv]);
        }
    }

    public function getAppLink($go=0, $data=[], $type='')
    {
        if ($go==1) {
            #第三方链接
            if (isset($data['other_link'])) {
                return $data['other_link'];
            } elseif (isset($data['origin_link'])) {
                return $data['origin_link'];
            } else {
                return $data['link'];
            }
        } elseif ($go==2) {
            #菜单（应用）链接
            $link = Db::table('guide_frame')->where(['id'=>$data['other_navbar']])->first();
            $link = objtoarr($link);
            return $link['link'];
        } elseif ($go==3) {
            #图文链接
            return '/txt_detail?id='.$data['other_pic'].'&type='.$type.'&oid='.$data['id'];
        } elseif ($go==4) {
            #消息链接
            return '/msg_detail?id='.$data['other_msg'].'&type='.$type.'&oid='.$data['id'];
        } elseif ($go==5) {
            #店铺链接
            return '/shop_detail?id='.isset($data['other_shop'])??$data['other_shop'];
        } elseif ($go==6) {
            #政策链接
            return '/policy_detail?id='.$data['other_privacy'].'&type='.$type.'&oid='.$data['id'];
        }
    }
}
