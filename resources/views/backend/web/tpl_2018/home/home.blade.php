<!--商家版首页-->
@include('layouts.header')

@if(!empty($data['websites']['rotate_info']) && $data['websites']['rotate_info']['location']==1)
    @include('layouts.rotate_info')
@endif
@if(!empty($data['websites']['menu']))
    @include('layouts.header2')
@endif
@if(!empty($data['websites']['rotate']))
    @include('home.rotate')
@endif
@if(!empty($data['websites']['rotate_info']) && $data['websites']['rotate_info']['location']==2)
    @include('layouts.rotate_info')
@endif
@if(!empty($data['websites']['recommendA']) || !empty($data['websites']['recommendB']))
    @include('home.recommend')
@endif
@if(!empty($data['websites']['guide']))
    @include('home.guide')
@endif

@include('layouts.footer')