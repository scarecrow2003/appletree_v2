<?php
/**
 * Apple Tree template for displaying the header
 *
 * @package WordPress
 * @subpackage Apple Tree
 * @since Apple Tree 1.0
 */
?>

<?php

function isPartOfCurrentMenuItem( $item )
{
    $uri = $_SERVER["REQUEST_URI"];
    if (strpos($uri, '?') !== false) {
        $uri = substr($uri, 0, strpos($uri, '?'));
    }

    if( $uri === '/' )
    {
        return false;
    }

    if ( strpos($item->url, $uri) !== false )
    {
        return true;
    }

    if ( $item->children && count($item->children)>0 )
    {
        foreach ( $item->children as $childItem )
        {
            if ( strpos($childItem->url, $uri) !== false )
            {
                return true;
            }
        }
    }

    return false;
}

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="ie ie-no-support" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>         <html class="ie ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title( ); ?></title>
		<meta name="viewport" content="width=device-width" />
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">

        <!-- Template stylesheets -->
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/bower_components/owl.carousel/dist/assets/owl.carousel.min.css" />

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div class="site container-fluid row-offcanvas row-offcanvas-right">

			<header class="site-header header-menu">

                <div class="header row">
                    <?php
                    $temp = pathinfo(get_page_template(), PATHINFO_FILENAME);
                    $hasBanner = $temp == 'template-home' || $temp == 'template-general' || is_front_page();
                    ?>
                    <div class="logo-container" <?php if ($hasBanner) { echo 'id="logo-banner"';} ?>>
                        <a href="/">
                            <img class="logo" alt="logo" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAACWAQMAAAAGz+OhAAAAA1BMVEX///+nxBvIAAAAAXRSTlMAQObYZgAAABpJREFUeNrtwTEBAAAAwqD1T20ND6AAAIB3Awu4AAFSPGZ8AAAAAElFTkSuQmCC">
                        </a>
                    </div>

                    <div class="col-xs-6 pull-right">
                        <div class="lang-container">
                            <?php
                            $uri = $_SERVER['REQUEST_URI'];
                            $qpos = strpos($uri, '?');
                            if ($qpos != -1) {
                                $uri = substr($uri, 0, $qpos);
                            }
                            ?>
                            <div class="lang" class="lang <?php if(isset($_GET['lang']) && $_GET['lang'] == 'zh') {?>selected<?php }?>">
                                <a href="<?php echo $uri;?>?lang=zh"><?php echo '中'; ?></a>
                            </div>
                            <div class="lang">|</div>
                            <div class="lang" class="lang <?php if(!isset($_GET['lang']) || $_GET['lang'] !='zh') {?>selected<?php }?>">
                                <a href="<?php echo $uri;?>?lang=en"><?php echo 'EN'; ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-xs-9 hidden-md hidden-lg pull-right">
                        <div class="head-social">
                            <ul>
                                <li>
                                    <a href="http://www.facebook.com/appletreestudiosg"  target="_blank">
                                        <div class="facebook"></div>
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.pinterest.com/appletreesg" target="_blank">
                                        <div class="pinterest"></div>
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:contactus@appletreesg.com">
                                        <div class="email"></div>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/appletreesg" target="_blank">
                                        <div class="twitter"></div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

				<div class="col-xs-9 col-xs-offset-3 col-md-8 col-md-offset-3 menu"><?php
                    $menuItems = wp_get_nav_menu_items('Header Menu');

                    $menuArray = array();
                    $lastParentMenuItem = null;

                    foreach ( $menuItems as $item )
                    {
                        if (!$item->menu_item_parent)
                        {
                            array_push($menuArray, $item);
                            $lastParentMenuItem = $item;
                            $lastParentMenuItem->children = array();
                        }
                        else
                        {
                            $lastParentMenuItem->children[] = $item;
                        }
                    }
                    ?>

                    <nav class="navbar menu" role="navigation">
                        <div>
                            <ul class="nav navbar-nav navbar-nav-custom">
                                <?php
                                foreach ( $menuArray as $item )
                                {
                                    if ( $item->children && count($item->children)>0 ) {
                                        $menuTitle = __($item->title, 'appletreesg.com');
                                        echo '<li class="dropdown">';
                                        echo '<a href="' . $item->url . '" class="dropdown-toggle menu-item-level-1 ' . (isPartOfCurrentMenuItem($item) ? 'active' : '') . '">' . $menuTitle . '</a>';

                                        echo '<ul class="dropdown-menu dropdown-menu-custom">';
                                        foreach ($item->children as $childItem) {
                                            $menuChildItem = __($childItem->title, 'appletreesg.com');
                                            echo '<li><a href="'.$childItem->url.'">'.$menuChildItem.'</a></li>';
                                        }
                                        echo '</ul>';
                                        echo '</li>';
                                    }
                                    else
                                    {
                                        $menuTitle = __($item->title, 'appletreesg.com');
                                        echo '<li><a href="' . $item->url .'" class="menu-item-level-1 menu-item-link ' . (isPartOfCurrentMenuItem( $item ) ? 'active' : '') . '">' . $menuTitle . '</a></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </nav>
				</div>

                <div class="col-md-1 hidden-xs hidden-sm">
                    <div class="head-social">
                        <ul>
                            <li>
                                <a href="http://www.facebook.com/appletreestudiosg"  target="_blank">
                                    <div class="facebook"></div>
                                </a>
                            </li>
                            <li>
                                <a href="http://www.pinterest.com/appletreesg" target="_blank">
                                    <div class="pinterest"></div>
                                </a>
                            </li>
                            <li>
                                <a href="mailto:contactus@appletreesg.com">
                                    <div class="email"></div>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/appletreesg" target="_blank">
                                    <div class="twitter"></div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="col-xs-9 dashed-sep pull-right"></div>

			</header>