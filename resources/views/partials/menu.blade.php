<style>
    table.dataTable.no-footer {
    margin: 0;
    width: 100% !important;
}
</style>
<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ url('/') }}" target="_blank" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    Website
                </a>
            </li>
            
            

            
            @can('users_manage')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-briefcase nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            <!-- <li class="nav-item">
                    <a href="{{ route('admin.currentprice.index') }}" class="nav-link {{ request()->is('admin/currentprice') || request()->is('admin/currentprice/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-fw fa-sitemap">

                        </i>
                        Gold Price
                    </a>
                </li>  -->

                @can('product_manage')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        Product Management
                    </a>



                <ul class="nav-dropdown-items">


                    <li class="nav-item">
                        <a href="{{ route('admin.product') }}" class="nav-link {{ request()->is('admin/product') || request()->is('admin/product/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-sitemap">

                            </i>
                        Add Product
                        </a>
                    </li>
    
    
                    <li class="nav-item">
                        <a href="{{ route('admin.product_categories.index') }}" class="nav-link {{ request()->is('admin/product_categories') || request()->is('admin/product_categories/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-sitemap">

                            </i>
                            Product Categories
                        </a>
                    </li>
    
                <li class="nav-item">
                    <a href="{{ route('admin.product-sub-category.index') }}" class="nav-link {{ request()->is('admin/product-sub-category') || request()->is('admin/product-sub-category/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-fw fa-sitemap">

                        </i>
                        Product Sub Categories 
                    </a>
                </li>
                <li class="nav-item">
                
                <a href="{{ route('admin.size.index') }}" class="nav-link {{ request()->is('admin/size') || request()->is('admin/size/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-fw fa-sitemap">

                    </i>
                  Product Weight 
                </a>
            </li>
        

            </ul>
        </li>
            
        @endcan   
                
                
                   <!-- <li class="nav-item">
                <a href="{{ route('admin.goals.index') }}" class="nav-link {{ request()->is('admin/goals') || request()->is('admin/goals/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-fw fa-sitemap">

                    </i>
                   Product Goal
                </a>
            </li> -->
                 <!-- <li class="nav-item">
                <a href="{{ route('admin.subcategories.index') }}" class="nav-link {{ request()->is('admin/subcategories') || request()->is('admin/subcategories/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-fw fa-sitemap">

                    </i>
                   Collections
                </a>
            </li>-->
                
                
                
                <!-- <li class="nav-item">
                    <a href="{{ route('admin.flavours.index') }}" class="nav-link {{ request()->is('admin/flavours') || request()->is('admin/flavours/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-fw fa-sitemap">

                        </i>
                        Flavours
                    </a>
                </li> -->


                @can('product_manage')       
               
               <li class="nav-item">
                    <a href="{{ route('admin.gst.index') }}" class="nav-link {{ request()->is('admin/gst') || request()->is('admin/gst/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-fw fa-sitemap">

                        </i>
                       GST
                    </a>
                </li>
                
                @endcan  


              
                @can('order_manage')       
               
               <li class="nav-item">
                    <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->is('admin/orders') || request()->is('admin/orders/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-fw fa-sitemap">

                        </i>
                       Orders
                    </a>
                </li>
                
                @endcan  
                

                
                @can('blog_manage')      
            
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        Blog Management
                    </a>



                    <ul class="nav-dropdown-items">


                        <li class="nav-item">
                            <a href="{{ route('admin.blog.index') }}" class="nav-link {{ request()->is('admin/blog') || request()->is('admin/blog/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-fw fa-sitemap">

                                </i>
                            Blogs
                            </a>
                        </li>
    
    
    
    
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->is('admin/categories') || request()->is('admin/categories/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-fw fa-sitemap">

                                </i>
                                Blog Categories 
                            </a>
                        </li>
                        <li class="nav-item">
                        
                            <a href="{{ route('admin.author.index') }}" class="nav-link {{ request()->is('admin/author') || request()->is('admin/author/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-fw fa-sitemap">

                                </i>
                            Blog Author 
                            </a>
                        </li>
            
            
                        <li class="nav-item">
                            <a href="{{ route('admin.tags.index') }}" class="nav-link {{ request()->is('admin/tags') || request()->is('admin/tags/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-fw fa-sitemap">

                                </i>
                            Blog Tags 
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan  


                <li class="nav-item">
                    <a href="{{ route('admin.shop-by-concern.index') }}" class="nav-link {{ request()->is('admin/shop-by-concern') || request()->is('admin/shop-by-concern/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-fw fa-sitemap"></i>
                        Add Concern
                    </a>                    
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.news.index') }}" class="nav-link {{ request()->is('admin/news') || request()->is('admin/news/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-fw fa-sitemap"></i>
                        Add Media
                    </a>                    
                </li>

                {{-- @can('seo_manage')  
                <li class="nav-item">
                <a href="{{ route('admin.seos.index') }}" class="nav-link {{ request()->is('admin/seos') || request()->is('admin/seos/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-fw fa-sitemap">

                    </i>
                  SEO Management 
                </a>
            </li>
            @endcan   --}}


            <li class="nav-item nav-dropdown {{ request()->is('admin/seos') || request()->is('admin/seos/*') || request()->is('admin/tracking') || request()->is('admin/sitemap') || request()->is('admin/robots') || request()->is('admin/ror') || request()->is('admin/urllist') ? 'open' : '' }}">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon fas fa-fw fa-sitemap fa-tools"></i>
                    SEO & Tracking Manage
                </a>                
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a href="{{ route('admin.seos.index') }}" class="nav-link {{ request()->is('admin/seos') || request()->is('admin/seos/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-sitemap"></i>
                             SEO
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.tracking.index') }}" class="nav-link {{ request()->is('admin/tracking') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-sitemap"></i>
                            Tracking Code
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.sitemap.index') }}" class="nav-link {{ request()->is('admin/sitemap') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-sitemap"></i>
                            Sitemap
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.robots.index') }}" class="nav-link {{ request()->is('admin/robots') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-sitemap"></i>
                            Robots
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.ror.index') }}" class="nav-link {{ request()->is('admin/ror') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-sitemap"></i>
                            Ror
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.urllist.index') }}" class="nav-link {{ request()->is('admin/urllist') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-sitemap"></i>
                            Urllist
                        </a>
                    </li>
                </ul>
            </li>


            
            @can('rating_manage')  
            <li class="nav-item">
                <a href="{{ route('admin.ratings.index') }}" class="nav-link {{ request()->is('admin/ratings') || request()->is('admin/ratings/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-fw fa-sitemap">

                    </i>
                    Ratings And Review 
                </a>
            </li>
            @endcan  

            
            @can('offer_manage')  
            <li class="nav-item">
                    <a href="{{ route('admin.coupon.index') }}" class="nav-link {{ request()->is('admin/coupon') || request()->is('admin/coupon/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-fw fa-sitemap">

                        </i>
                       Coupons
                    </a>
                </li>

                
            

            
            @endcan 




            <li class="nav-item nav-dropdown">
                <a class="nav-link  nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users nav-icon">

                    </i>
                    Refer & Earn
                </a>



                <ul class="nav-dropdown-items">


                    <li class="nav-item">
                        <a href="{{ route('admin.home') }}" class="nav-link">
                            <i class="nav-icon fas fa-fw fa-tachometer-alt">

                            </i>
                            {{ trans('global.dashboard') }}
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.referinfluencer.index') }}" class="nav-link {{ request()->is('admin/referinfluencer') || request()->is('admin/referinfluencer/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-sitemap">

                            </i>
                            Add Influencer
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('admin.influencer_redeem.index') }}" class="nav-link {{ request()->is('admin/influencer_redeem') || request()->is('admin/influencer_redeem/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-sitemap">

                            </i>
                            Influencer Points Approval
                        </a>
                    </li>




                    <li class="nav-item">
                        <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->is('admin/categories') || request()->is('admin/categories/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-sitemap">

                            </i>
                            Blog Categories 
                        </a>
                    </li>
                    <li class="nav-item">
                    
                        <a href="{{ route('admin.author.index') }}" class="nav-link {{ request()->is('admin/author') || request()->is('admin/author/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-sitemap">

                            </i>
                        Blog Author 
                        </a>
                    </li>
        
        
                    <li class="nav-item">
                        <a href="{{ route('admin.tags.index') }}" class="nav-link {{ request()->is('admin/tags') || request()->is('admin/tags/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-fw fa-sitemap">

                            </i>
                        Blog Tags 
                        </a>
                    </li>
                </ul>
            </li>
            



            @can('lead_manage')  
            <li class="nav-item">
                <a href="/admin/contact" class="nav-link {{ request()->is('/admin/contact') || request()->is('/admin/contact/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-fw fa-sitemap">

                    </i>
                    Contacts
                </a>
            </li>


            <li class="nav-item">
                <a href="/admin/survey" class="nav-link {{ request()->is('/admin/survey') || request()->is('/admin/survey/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-fw fa-sitemap">

                    </i>
                    Survey
                </a>
            </li>

            @endcan 


            <li class="nav-item">
                <a href="{{ route('admin.imagealt.index') }}" class="nav-link {{ request()->is('/admin/imagealt') || request()->is('/admin/imagealt/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-fw fa-sitemap">

                    </i>
                    ImageAlt-count
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.formtype.index') }}" class="nav-link {{ request()->is('/admin/formtype') || request()->is('/admin/formtype/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-fw fa-sitemap">

                    </i>
                    FormType
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.dynamic-email.index') }}" class="nav-link {{ request()->is('/admin/dynamic-email') || request()->is('/admin/dynamic-email/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-fw fa-sitemap">

                    </i>
                    Dynamic-Emails
                </a>
            </li>
          
            
            <li class="nav-item">
                <a href="{{ route('admin.abandonedcart.index') }}" class="nav-link {{ request()->is('/admin/abandonedcart') || request()->is('/admin/abandonedcart/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-fw fa-sitemap">

                    </i>
                    Abandoned Cart
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.registeredusers.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-sitemap">

                    </i>
                    Verified Users
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.unregisteredusers.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-sitemap">

                    </i>
                    Unverified Users
                </a>
            </li>
           
            @can('users_manage')
            <li class="nav-item">
                <a href="{{ route('auth.change_password') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-key">

                    </i>
                    Change Password
                </a>
            </li>
            @endcan 

            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
