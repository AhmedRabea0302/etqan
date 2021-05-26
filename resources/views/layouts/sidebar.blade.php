<aside class="main-sidebar">
    <!-- Logo -->
    <a href="{{url('/home')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <img class="logo-mini" src="{{asset('assets/images/logo.png')}}">
        <!-- logo for regular state and mobile devices -->
        <img class="logo-lg img-responsive img-center" src="{{asset('assets/images/logo.png')}}">
    </a>
    <ul class="sidebar-links">
        <li @if(Request::route()->getName() == 'home') class="active" @endif>
            <a href="{{url('/admin/home')}}" >
                <i class="fa fa-dashboard"></i>
                <span>الرئيسية</span>
            </a>
        </li>

        <li @if(Request::route()->getName() == 'admins' || Request::route()->getName() == 'get-admin-edit-page') class="active" @endif>
            <a href="{{url('/admins')}}" >
                <i class="fa fa-cogs"></i>
                <span>المُدراء</span>
            </a>
        </li>

        <li class="treeview @if(Request::route()->getName() == 'add-suspicion' || Request::route()->getName() == 'all-suspicions') active @endif">
            <a href="#">
                <i class="fa fa-list-ol"></i>
                <span>الشبُهات</span>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{{route('add-suspicion')}}">
                        <span>إضافة شبُهة</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('all-suspicions')}}">
                        <span>عرض الشبُهات</span>
                    </a>
                </li>
            </ul><!--End Level-one-tree-->
        </li>  
        
        <li class="treeview @if(Request::route()->getName() == 'add-hot-suspicion' || Request::route()->getName() == 'all-hot-suspicions') active @endif">
            <a href="#">
                <i class="fa fa-fire"></i>
                <span> الشبُهات الساخنة</span>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{{route('add-hot-suspicion')}}">
                        <span> إضافة شبُهة ساخنة</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('all-hot-suspicions')}}">
                        <span>عرض الساخنة</span>
                    </a>
                </li>
            </ul><!--End Level-one-tree-->
        </li> 

        <li class="treeview @if(Request::route()->getName() == 'get-add-evidence' || Request::route()->getName() == 'all-evidences') active @endif">
            <a href="#">
                <i class="fa fa-balance-scale"></i>
                <span> الأدلة</span>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{{route('get-add-evidence')}}">
                        <span> إضافة دليل</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('all-evidences')}}">
                        <span>عرض الأدلة</span>
                    </a>
                </li>
            </ul><!--End Level-one-tree-->
        </li> 

        <li class="treeview @if(Request::route()->getName() == 'get-add-discussion' || Request::route()->getName() == 'all-discussions' || Request::route()->getName() == 'discussion-content' ) active @endif">
            <a href="#">
                <i class="fa fa-cubes"></i>
                <span>المناظرات</span>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{{route('get-add-discussion')}}">
                        <span>إضافة مناظرة</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('all-discussions')}}">
                        <span>عرض المناظرات</span>
                    </a>
                </li>
            </ul><!--End Level-one-tree-->
        </li> 

        <li class="treeview @if(Request::route()->getName() == 'add-marsad' || Request::route()->getName() == 'all-marasads') active @endif">
            <a href="#">
                <i class="fa fa-eye"></i>
                <span>المرصد</span>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{{route('add-marsad')}}">
                        <span>إضافة مرصد</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('all-marasads')}}">
                        <span>عرض المراصد</span>
                    </a>
                </li>
            </ul><!--End Level-one-tree-->
        </li> 

        <li @if(Request::route()->getName() == 'meets' || Request::route()->getName() == 'get-update-meet') class="active" @endif>
            <a href="{{url('/meets')}}" >
                <i class="fa fa-link"></i>
                <span>روابط الإجتماعات</span>
            </a>
        </li>


        <li @if((Request::route()->getName() == 'infographs') || (Request::route()->getName() == 'get-update-infograph')) class="active" @endif>
            <a href="{{url('/infographs')}}" >
                <i class="fa fa-picture-o"></i>
                <span>إنفوجرافيك</span>
            </a>
        </li>

        <li @if((Request::route()->getName() == 'get-sheikhs') || (Request::route()->getName() == 'get-sheikh-edit-page')) class="active" @endif>
            <a href="{{route('get-sheikhs')}}" >
                <i class="fa fa-magnet"></i>
                <span>المشايخ</span>
            </a>
        </li>

        <li @if((Request::route()->getName() == 'about')) class="active" @endif>
            <a href="{{route('about')}}" >
                <i class="fa fa-newspaper-o"></i>
                <span>الصفحة التعريفية</span>
            </a>
        </li>

        {{-- <li class="treeview">
            <a href="#">
                <i class="fa fa-newspaper-o"></i>
                <span>صفحات الموقع</span>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="slider-page.html">
                        <span>الإسلايد شو</span>
                    </a>
                </li>
                <li>
                    <a href="static-data.html">
                        <span>البيانات الثابتة</span>
                    </a>
                </li>
                <li>
                    <a href="about-us.html">
                        <span>من نحن</span>
                    </a>
                </li>
                <li>
                    <a href="solutions.html">
                        <span>حلولنا</span>
                    </a>
                </li>
                <li>
                    <a href="customers.html">
                        <span>العملاء</span>
                    </a>
                </li>
                <li>
                    <a href="partners.html">
                        <span>الشركاء</span>
                    </a>
                </li>
                <li>
                    <a href="articles.html">
                        <span>المقالات</span>
                    </a>
                </li>
                <li>
                    <a href="services.html">
                        <span>الخدمات</span>
                    </a>
                </li>
                <li>
                    <a href="contact-us.html">
                        <span>تواصل معنا</span>
                    </a>
                </li>
            </ul><!--End Level-one-tree-->
        </li>       
        <li class="treeview">
            <a href="#">
                <i class="fa fa-list-ol"></i>
                <span>الفئات</span>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="main-categories.html">
                        <span>الفئات الرئيسية</span>
                    </a>
                </li>
                <li>
                    <a href="sub-categories.html">
                        <span>الفئات الفرعية</span>
                    </a>
                </li>
                <li>
                    <a href="sub-sub-categories.html">
                        <span>الفئات الجزء فرعية</span>
                    </a>
                </li>
            </ul><!--End Level-one-tree-->
        </li>            
        <li>
            <a href="products.html">
                <i class="fa fa-cubes"></i>
                <span>المنتجات</span>
            </a>
        </li>
        
        <li>
            <a href="messages.html">
                <i class="fa fa-comments"></i>
                <span>الرسائل</span>
            </a>
        </li>
        <li>
            <a href="subscription.html">
                <i class="fa fa-check-square-o"></i>
                <span>الإشتراكات</span>
            </a>
        </li>
        
        <li class="treeview">
            <a href="#">
                <i class="fa fa-cogs"></i>
                <span>الإعدادات</span>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="site-settings.html">
                        <span>بيانات الموقع</span>
                    </a>
                </li>
            </ul><!--End Level-one-tree-->
        </li> --}}
    </ul><!--End sidebar-->
</aside><!--End Main-aside-->