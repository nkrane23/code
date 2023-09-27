<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="container-fluid no-padding">
                <div class="error-404">
                    <div class="wrap">
                        <h2>Error 404 - Not Found</h2>
                        <p>That page you requested doesn't seem to exist.</p>
                        <p>¯\_(ツ)_/¯</p>

                        <form>
                            <input id="back" type="button" onclick="history.go(-1)" value="Back To Previous Page">
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

<?php get_footer();
