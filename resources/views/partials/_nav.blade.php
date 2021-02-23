@php
    function buildNavMenu($mainMenu, $level = 0)
    {
        $output = '';
        $lang = '';
        $output .= '<ul';
        if($level < 1) { $output .= ' class="main-menu-top" '; }
        $output .= '>';
            foreach($mainMenu as $item) {
                if (isset($item->children)) {
                    $output .= '<li class="parent"><a href="' . $item->link . '">' . $item->name . '</a>';
                        $output .= buildNavMenu($item->children, $level++);
                    $output .= '</li>';
                } else {
                    if(env('CURRENT_LOCALE') !== app()->getLocale()) {
                        $lang = '/' . app()->getLocale();
                    }
                    $output .= '<li><a href="' . $lang . $item->link  . '">' . $item->name . '</a></li>';
                }
            }

            $output .= '</ul>';
        return $output;
    }
@endphp

{!! buildNavMenu($mainMenu) !!}
<div class="mobile-menu-trigger"><i class="fa fa-navicon"></i></div>
<span class="close-mobile-menu"><i class="fa fa-times"></i></span>
