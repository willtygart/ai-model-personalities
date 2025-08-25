<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="page" class="site">
        
        <!-- Header -->
        <header id="masthead" class="site-header">
            <div class="container">
                <div class="site-branding">
                    <div class="site-info">
                        <?php if (has_custom_logo()) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <h1 class="site-title">
                                <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
                            </h1>
                            <?php if (get_bloginfo('description')) : ?>
                                <p class="site-description"><?php bloginfo('description'); ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Deployment Info -->
                    <div class="deployment-info">
                        🚀 GitHub Connected
                    </div>
                </div>
            </div>
        </header>

        <!-- Navigation -->
        <nav id="site-navigation" class="main-navigation">
            <div class="container">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id' => 'primary-menu',
                    'fallback_cb' => function() {
                        echo '<ul><li><a href="' . esc_url(home_url('/')) . '">Home</a></li></ul>';
                    }
                ));
                ?>
            </div>
        </nav>

        <!-- Main Content -->
        <div id="content" class="site-content">
            <div class="container">
                <div class="content-area">
                    
                    <!-- Main Content Area -->
                    <main id="main" class="site-main">
                        
                        <?php if (have_posts()) : ?>
                            
                            <?php if (is_home() && !is_front_page()) : ?>
                                <header>
                                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                                </header>
                            <?php endif; ?>
                            
                            <?php while (have_posts()) : the_post(); ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    
                                    <header class="entry-header">
                                        <?php if (is_singular()) : ?>
                                            <h1 class="entry-title"><?php the_title(); ?></h1>
                                        <?php else : ?>
                                            <h2 class="entry-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h2>
                                        <?php endif; ?>
                                        
                                        <?php if (!is_page()) : ?>
                                            <div class="entry-meta">
                                                <span class="posted-on">
                                                    📅 <?php echo get_the_date(); ?>
                                                </span>
                                                <span class="byline">
                                                    👤 <?php the_author(); ?>
                                                </span>
                                                <?php if (get_the_category()) : ?>
                                                    <span class="cat-links">
                                                        🏷️ <?php the_category(', '); ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </header>
                                    
                                    <?php if (has_post_thumbnail() && !is_singular()) : ?>
                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('medium'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="entry-content">
                                        <?php
                                        if (is_singular()) {
                                            the_content();
                                            
                                            wp_link_pages(array(
                                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'tygartmedia'),
                                                'after' => '</div>',
                                            ));
                                        } else {
                                            the_excerpt();
                                            echo '<p><a href="' . get_the_permalink() . '" class="read-more">Read More →</a></p>';
                                        }
                                        ?>
                                    </div>
                                    
                                    <?php if (is_singular() && get_the_tags()) : ?>
                                        <footer class="entry-footer">
                                            <div class="tag-links">
                                                🔖 <?php the_tags('', ', '); ?>
                                            </div>
                                        </footer>
                                    <?php endif; ?>
                                    
                                </article>
                            <?php endwhile; ?>
                            
                            <!-- Pagination -->
                            <div class="navigation pagination">
                                <?php
                                the_posts_pagination(array(
                                    'prev_text' => '← Previous',
                                    'next_text' => 'Next →',
                                ));
                                ?>
                            </div>
                            
                        <?php else : ?>
                            
                            <!-- No Content Found -->
                            <section class="no-results not-found">
                                <header class="page-header">
                                    <h1 class="page-title"><?php esc_html_e('Nothing Found', 'tygartmedia'); ?></h1>
                                </header>
                                
                                <div class="page-content">
                                    <?php if (is_home() && current_user_can('publish_posts')) : ?>
                                        <p><?php
                                        printf(
                                            wp_kses(
                                                __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'tygartmedia'),
                                                array('a' => array('href' => array()))
                                            ),
                                            esc_url(admin_url('post-new.php'))
                                        );
                                        ?></p>
                                    <?php elseif (is_search()) : ?>
                                        <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'tygartmedia'); ?></p>
                                    <?php else : ?>
                                        <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'tygartmedia'); ?></p>
                                    <?php endif; ?>
                                    
                                    <?php get_search_form(); ?>
                                </div>
                            </section>
                            
                        <?php endif; ?>
                        
                    </main>
                    
                    <!-- Sidebar -->
                    <aside id="secondary" class="widget-area">
                        <?php if (is_active_sidebar('sidebar-1')) : ?>
                            <?php dynamic_sidebar('sidebar-1'); ?>
                        <?php else : ?>
                            <!-- Default Sidebar Content -->
                            <div class="widget">
                                <h3 class="widget-title">About TygartMedia</h3>
                                <p>Professional web development and digital marketing services.</p>
                                <p><strong>GitHub Connected:</strong> This site is automatically deployed from GitHub.</p>
                            </div>
                            
                            <div class="widget">
                                <h3 class="widget-title">Recent Activity</h3>
                                <ul>
                                    <li>✅ WordPress site deployed</li>
                                    <li>🔄 GitHub CI/CD configured</li>
                                    <li>🌐 Cloudflare DNS active</li>
                                    <li>📱 Responsive design implemented</li>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </aside>
                    
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer id="colophon" class="site-footer">
            <div class="container">
                <div class="footer-content">
                    <?php if (is_active_sidebar('sidebar-2')) : ?>
                        <?php dynamic_sidebar('sidebar-2'); ?>
                    <?php else : ?>
                        <div class="footer-section">
                            <h4>TygartMedia</h4>
                            <p>Professional WordPress development with modern deployment workflows.</p>
                        </div>
                        <div class="footer-section">
                            <h4>Services</h4>
                            <ul>
                                <li>WordPress Development</li>
                                <li>GitHub CI/CD Setup</li>
                                <li>Google Cloud Hosting</li>
                                <li>Cloudflare Integration</li>
                            </ul>
                        </div>
                        <div class="footer-section">
                            <h4>Technology Stack</h4>
                            <ul>
                                <li>🚀 GitHub Actions</li>
                                <li>☁️ Google Cloud Platform</li>
                                <li>🔒 Cloudflare Security</li>
                                <li>📱 Responsive Design</li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="footer-info">
                    <p>
                        &copy; <?php echo date('Y'); ?> 
                        <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
                        | 
                        Deployed via 
                        <a href="https://github.com/willtygart/ai-model-personalities" target="_blank">GitHub</a>
                        | 
                        Powered by <a href="https://wordpress.org/" target="_blank">WordPress</a>
                    </p>
                </div>
            </div>
        </footer>
        
    </div>

    <?php wp_footer(); ?>
    
    <!-- GitHub Deployment Tracking -->
    <script>
        console.log('🚀 TygartMedia WordPress Theme - Deployed from GitHub');
        console.log('📊 Repository: willtygart/ai-model-personalities');
        console.log('🌐 Site: <?php echo home_url(); ?>');
    </script>
    
</body>
</html>