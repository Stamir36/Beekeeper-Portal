<!-- Pageloader -->   
<div class="pageloader"></div>
        <div class="infraloader is-active"></div>
        <nav class="navbar mobile-navbar is-hidden-desktop is-hidden-tablet" aria-label="main navigation">
            <!-- Brand -->
            <div class="navbar-brand">
                <a class="navbar-item" href="?">
                    <img src="https://img.icons8.com/fluent/48/000000/shopping-bag.png" alt="">
                </a>
        
                <!-- Sidebar mode toggler icon -->
                <a id="sidebar-mode" class="navbar-item is-icon is-sidebar-toggler" href="javascript:void(0);">
                    <i data-feather="sidebar"></i>
                </a>
        
                <!-- Mobile menu toggler icon -->
                <div class="navbar-burger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <!-- Navbar mobile menu -->
            <div class="navbar-menu">
                <!-- Account -->
                <div class="navbar-item has-dropdown">
                    <a class="navbar-link">
                        <?php
                            if(strlen(htmlspecialchars($_COOKIE["id"])) > 0){ // ПОИСК АВТОРИЗАЦИИ
                                echo("
                                    <img id='user_avatar' src='/../../../../data/users/avatar/".$avatar."' class='round' width='40px' height='40px'>
                                    <span class='is-heading'>".$name."</span>
                                ");
                            }else{
                                echo("
                                    <img id='user_avatar' src='/../../../../data/users/avatar/default.png' class='round' width='40px' height='40px'>
                                    <span class='is-heading'>Вход не выполнен</span>
                                ");
                            }
                        ?>                         
                    </a>
        
                    <!-- Mobile Dropdown -->
                    <div class="navbar-dropdown">
                        <a href="/../../../../shop/" class="navbar-item">Головна сторінка</a>
                        <a href="/../../../../shop/new/" class="navbar-item">Нове оголошення</a>
                        <a href="/../../../../shop/my/" class="navbar-item">Мої оголошення</a>
                        <a href="/../../../../shop/liked/" class="navbar-item">Мій кошик</a>
                    </div>
                </div>
        
                <!-- More -->
                <div class="navbar-item has-dropdown">
                    <a class="navbar-link">
                        <i data-feather="grid"></i>
                        <span class="is-heading">Категорії</span>
                    </a>
        
                    <!-- Mobile Dropdown -->
                    <div class="navbar-dropdown">
                        <a href="/../../../../shop/catalog/?c=home" class="navbar-item">Для дому</a>
                        <a href="/../../../../shop/catalog/?c=pasick" class="navbar-item">Для пасіки</a>
                        <a href="/../../../../shop/catalog/?c=online" class="navbar-item">Онлайн матеріали</a>
                        <a href="/../../../../shop/catalog/?c=work" class="navbar-item">Робота</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Main Sidebar-->
        <div class="main-sidebar">
            <div class="sidebar-brand">
                <a href="/../../../../shop/"><img src="https://img.icons8.com/fluent/48/000000/shopping-bag.png" alt=""></a>
            </div>
            <div class="sidebar-inner">
                <ul class="icon-menu">
                    <!-- Shop sidebar trigger -->
                    <li>
                        <a href="javascript:void(0);" id="open-shop"><i data-feather="home"></i></a>
                    </li>            <!-- Cart sidebar trigger -->
                    <li>
                        <a href="javascript:void(0);" id="open-cart"><i data-feather="shopping-cart"></i></a>
                    </li>            <!-- Search trigger -->
                    <li>
                        <a href="javascript:void(0);" id="open-search"><i data-feather="search"></i></a>
                        <a href="javascript:void(0);" id="close-search" class="is-hidden is-inactive"><i data-feather="x"></i></a>
                    </li>            <!-- Mobile mode trigger -->
                    <li class="is-hidden-desktop is-hidden-tablet">
                        <a href="javascript:void(0);" id="mobile-mode"><i data-feather="smartphone"></i></a>
                    </li>        </ul>
        
                <!-- User account -->
                <ul class="bottom-menu is-hidden-mobile">
                    <li>
                    <?php
                        if(strlen(htmlspecialchars($_COOKIE["id"])) > 0){ // ПОИСК АВТОРИЗАЦИИ
                            echo("
                                <a href='/shop/profile/'><i>    
                                <img id='user_avatar' src='/../../../../data/users/avatar/".$avatar."' class='round' width='40px' height='40px'>
                            ");
                        }else{
                            echo("
                                <a href='/login/'><i> 
                                <img data-feather='user' id='user_avatar' src='/../../../../data/users/avatar/default.png' class='round' width='40px' height='40px'>
                            ");
                        }
                    ?>
                </i></a></li>
                </ul>
            </div>
        </div>
        <!-- /Main Sidebar-->
        
        <!-- FAB -->
        <div id="quickview-trigger"  class="menu-fab is-hidden-mobile">
            <a class="hamburger-btn" href="javascript:void(0);">
                <span class="menu-toggle">	
                    <span class="icon-box-toggle"> 	
                        <span class="rotate">
                            <i class="icon-line-top"></i>
                            <i class="icon-line-center"></i>
                            <i class="icon-line-bottom"></i> 
                        </span>
                    </span>
                </span>
            </a>
        </div><!-- /FAB -->
        
        <!-- Categories Right quickview -->
        <div class="category-quickview">
            <div class="inner">
                <ul class="category-menu">
                    <li>
                        <a href="/../../../../shop/catalog/?c=home">
                            <span>Для дому</span>
                            <img src="https://img.icons8.com/fluent/48/000000/cottage.png"/>
                        </a>
                    </li>
                    <li>
                        <a href="/../../../../shop/catalog/?c=pasick">
                            <span>Для пасіки</span>
                            <img src="https://img.icons8.com/fluent/48/000000/beeswax.png"/>
                        </a>
                    </li>
                    <li>
                        <a href="/../../../../shop/catalog/?c=online">
                            <span>Онлайн матеріали</span>
                            <img src="https://img.icons8.com/fluent/48/000000/book-stack.png"/>
                        </a>
                    </li>
                    <li>
                        <a href="/../../../../shop/catalog/?c=work">
                            <span>Робота</span>
                            <img src="https://img.icons8.com/fluent/48/000000/find-matching-job.png"/>
                        </a>
                    </li>
                    <li>
                        <a href="/../../../../shop/catalog/?c=ect">
                            <span>Інше</span>
                            <img src="https://img.icons8.com/fluent/48/000000/window-other.png"/>
                        </a>
                    </li>
                </ul>
        
                
                <div class="all-categories is-hidden-mobile">
                    <a href="/../../../../shop/catalog/?c=all">Всі категорії</a>
                    <div class="centered-divider"></div>
                </div>
                
            </div>
        </div>
        <!-- Shop quickview -->
        <div class="shop-quickview has-background-image" data-background="/assets/img/polyans/abstract-lines.svg">
            <div class="inner">
                <!-- Header -->
                <div class="quickview-header">
                    <h2>Меню</h2>
                    <span id="close-shop-sidebar"><i data-feather="x"></i></span>
                </div>
                <!-- Shop menu -->
                <ul class="shop-menu">
                    <li>
                        <a href="/../../../../shop/">
                            <span>Головна сторінка</span>
                            <i data-feather="home"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/../../../../shop/new/">
                            <span>Нове оголошення</span>
                            <i data-feather="plus"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/../../../../shop/my/">
                            <span>Мої оголошення</span>
                            <i data-feather="grid"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/../../../../shop/liked/">
                            <span>Мій кошик</span>
                            <i data-feather="shopping-cart"></i>
                        </a>
                    </li>
                </ul>
                <?php
                                $cook_id = htmlspecialchars($_COOKIE["id"]);
                                if(strlen($cook_id) > 0){ // ПОИСК АВТОРИЗАЦИИ
                                    echo("
                                    <ul class='user-profile'>
                                        <li>
                                            <a href='/shop/profile/'>
                                                <img id='user_avatar' src='/../../../../../data/users/avatar/".$avatar."' class='round' width='40px' height='40px'>
                                                <span class='user'>
                                                    <span>".$name."</span>
                                                    <span>В особистий кабінет</span>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                    ");
                                }else{
                                    echo("
                                    <ul class='user-profile'>
                                        <li>
                                            <a href='/shop/profile/'>
                                                <img id='user_avatar' src='/../../../../../data/users/avatar/default.png' class='round' width='40px' height='40px'>
                                                <a href='../login/'>
                                                    <span class='user'>
                                                        <span>Вітаю, Гість</span>
                                                        <span>Авторизуватися</span>
                                                    </span>
                                                </a>
                                            </a>
                                        </li>
                                    </ul>
                                    ");
                                }
                            ?>
            </div>
        </div>
        <script>
            var add_code="<div class='cart-body' id='none_card'><div class='empty-cart has-text-centered'><h3>Тут пусто...</h3><img src='/../../../../shop/assets/images/icons/new-cart.svg' alt=''><a href='/../../../../shop/' class='button big-button rounded'>Почніть купувати</a><small></small></div></div>";
        </script>
        <!-- Cart quickview -->
        <div class="cart-quickview" style="box-shadow: 1px 0px 5px 0px rgba(50, 50, 50, 0.5);">
            <div class="inner" style="overflow: auto; height: 100%;">
                <!-- Header -->
                <div class="quickview-header" style='background: #fff; position: fixed; top: 0; width: 100%; z-index: 100;'>
                    <h2>Мій кошик</h2>
                    <span id="close-cart-sidebar" style="right: 0;"><i data-feather="x"></i></span>
                </div>
                <div class="quickview-header">
                    <h2></h2>
                    <span id="close-cart-sidebar"></span>
                </div>
                <div id="inner"></div>
                <?php
                    $cook_id = htmlspecialchars($_COOKIE["id"]);
                    if(strlen($cook_id) > 0){ // ПОИСК АВТОРИЗАЦИИ
                    $product_liked = $mysql->query("SELECT * FROM `liked_shop` WHERE `user_liked` = $cook_id");
                    $product_id = Array();
                    $name_product = Array();
                    $product_image = Array();
                    $product_price = Array();

                    while($result = $product_liked->fetch_assoc()){
                        $product_id[] = $result['product_id'];
                        $name_product[] = $result['name_product'];
                        $product_image[] = $result['product_image'];
                        $product_price[] = $result['product_price'];
                    }

                    $num_liked_prod = 0;

                    if(count($product_id) == count($name_product) && count($product_image) != 0 && count($product_price) != 0 ){
                        $total_sum = 0;
                        echo("<div class='cart-body'>
                        <ul class='shopping-cart-items'> <div id='innerProduct'></div>");
                        while($num_liked_prod <= (count($name_product) - 1)){
                            echo("
                            <!-- Item -->
                            <li class='clearfix' id='block_".$product_id[$num_liked_prod]."'>
                            <div style='width: 70px; justify-content: center; display: inline block; text-align: center;'>
                                <img src='/shop/catalog/image/".$product_image[$num_liked_prod]."' alt='' style='cursor: pointer; float: initial;' onclick='document.location.href = `/shop/product/?id=".$product_id[$num_liked_prod]."`;' />
                            </div>
                                <span class='item-meta' style='width: 150px; cursor: pointer;' onclick='document.location.href = `/shop/product/?id=".$product_id[$num_liked_prod]."`;'>
                                    <span class='item-name' style='width: 150px;'>".$name_product[$num_liked_prod]."</span>
                                    <span class='item-price'>".$product_price[$num_liked_prod]."₴</span>
                                </span>

                                <span class='remove-item'>
                                    <i data-feather='x' class='has-simple-popover' data-content='Видалити з кошика' data-placement='top' onclick='$.ajax({ url: `/shop/product/no_like.php`, type: `POST`, data:{product_id: ".$product_id[$num_liked_prod]."}, success: function(data) { document.getElementById(`block_` + ".$product_id[$num_liked_prod].").remove(); document.getElementById(`all_price`).textContent = document.getElementById(`all_price`).textContent - ".$product_price[$num_liked_prod]."; if(document.getElementById(`all_price`).textContent == 0){ document.getElementById(`total_sum_block`).style.display = `none`; document.getElementById(`inner`).innerHTML = add_code;} } }); del_like(".$product_id[$num_liked_prod].", ".$product_price[$num_liked_prod].");'></i>
                                </span>
                            </li>
                            ");
                            $total_sum = $total_sum + $product_price[$num_liked_prod];
                            $num_liked_prod = $num_liked_prod + 1;
                        }
                        echo("
                            <div class='cart-action' id='total_sum_block' style='position: fixed; bottom: 0; width: 100%;'>
                                <span class='cart-total' style='cursor: default;'>
                                    <small>₴</small><span id='all_price'>".$total_sum."</span>
                                </span>
                                <a href='/shop/liked/' class='button primary-button upper-button raised is-bold'>
                                    <span>Детальніше</span>
                                </a>
                            </div>
                        </ul>
                            </div>
                        ");
                    }else{
                        echo("
                        <div class='cart-body' id='none_card'>
                            <div class='empty-cart has-text-centered'>
                                <h3>Тут пусто...</h3>
                                <img src='/../../../../shop/assets/images/icons/packpage.svg' alt=''>
                                <a href='/../../../../shop/' class='button big-button rounded'>Почніть купувати</a>
                                <small></small>
                            </div>
                        </div>
                        ");
                    echo("<div class='cart-body'>
                        <ul class='shopping-cart-items'>
                            <div id='innerProduct'></div>
                            <div class='cart-action' id='total_sum_block' style='display: none; position: fixed; bottom: 0; width: 100%;'>
                                <span class='cart-total' style='cursor: default;'>
                                    <small>₴</small><span id='all_price'>".$total_sum."</span>
                                </span>
                                <a href='/shop/liked/' class='button primary-button upper-button raised is-bold'>
                                    <span>Детальніше</span>
                                </a>
                            </div>
                        </ul>
                    </div>");
                    }
                }else{
                    echo("
                        <div class='cart-body' id='none_card'>
                            <div class='empty-cart has-text-centered'>
                                <h3>Зареєструйтеся та почніть купувати!</h3>
                                <img src='/../../../../shop/assets/images/icons/packpage.svg' alt=''>
                                <a href='/../../../../login/' class='button big-button rounded'>Реєстрація / Вхід</a>
                                <small></small>
                            </div>
                        </div>
                    ");
                }
                ?>
                <script>
                    function del_like(id, price){
                        $.ajax({
                        url: '/shop/product/no_like.php',
                        type: 'POST',
                        data:{product_id: id},
                        success: function(data) {
                            document.getElementById("block_" + id).remove();
                            document.getElementById("all_price").textContent = document.getElementById("all_price").textContent - price;
                            if(document.getElementById("all_price").textContent == 0){
                                document.getElementById("total_sum_block").style.display = "none";
                                var add_code="<div class='cart-body' id='none_card'><div class='empty-cart has-text-centered'><h3>Тут пусто...</h3><img src='/../../../../shop/assets/images/icons/new-cart.svg' alt=''><a href='/../../../../shop/' class='button big-button rounded'>Почніть купувати</a><small></small></div></div>";
                                document.getElementById("inner").innerHTML = add_code;
                            }   
                        }
                        });
                        
                        if(<?php echo($id)?> == id){
                            document.getElementById('like').textContent = 'Зберегти в кошик 💛';
                            document.getElementById('like').setAttribute('onclick','like()');
                            document.getElementById('liked_block').style.background = '#EF92C6';
                            document.getElementById('like').style.color = '#fff';
                        }
                    }
                </script>
            </div>
        </div>
        <!-- Main wrapper -->
        <div class="shop-wrapper">
        
            <!-- Search overlay -->
            <div class="search-overlay"></div>
            
            <!-- Search input -->
            <div class="search-input-wrapper is-desktop is-hidden">
                <div class="field">
                    <div class="control">
                        <input type="text" name="search" id="search" value='<?php echo($value_search);?>' autofocus required>
                        <span id="clear-search" role="button"><i data-feather="x"></i></span>
                        <span class="search-help">Введіть назву товару, який ви шукаєте</span>
                        <button id="go_search" onclick="document.location.href = '/shop/search/?s=' + document.getElementById('search').value;" style="display: none;"></button> 
                    </div>
                </div>
            </div>