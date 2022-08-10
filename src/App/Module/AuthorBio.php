<?php

namespace Alexandra\App\Module;

use Alexandra\App\Abstracts\ModuleManager;

class AuthorBio extends ModuleManager
{
    public function register()
    {
        $settings = get_option(MODULE_SETTINGS_SLUG);

        if (!isset($settings ['author_bio']) || !$settings ['author_bio']) {
            return;
        }

        add_filter('user_contactmethods', [$this, 'socialMetaFieldToUserProfile']);
        add_filter('the_content', [$this, 'addAuthorBioToPost']);

        add_action('init', [$this, 'enqueueStyleSheet']);
    }

    public function socialMetaFieldToUserProfile($methods)
    {
        $methods['twitter'] = 'Twitter';
        $methods['facebook'] = 'Facebook';
        $methods['linkedin'] = 'LinkedIn';

        return $methods;
    }

    public function markup($user)
    {
        $data = '
                <div class="content">
                  <div class="card">
                    <div class="firstinfo"><img src="https://randomuser.me/api/portraits/lego/6.jpg"/>
                      <div class="profileinfo">
                        <h1>' . $user['name'] . '</h1>
                        <p class="bio">' . $user['bio'] . '</p>
                      </div>
                    </div>
                  </div>
                  <div class="badgescard">
                  <a href="' . $user['facebook'] . '"><i class="fa-brands fa-facebook"></i></a>
                  <a href="' . $user['twitter'] . '"><i class="fa-brands fa-twitter"></i></a>
                  <a href="' . $user['linkedin'] . '"><i class="fa-brands fa-linkedin"></i></a>
                  </div>
                </div>
        ';

        return $data;
    }

    public function addAuthorBioToPost($content)
    {
        global $post;

        $author = get_user_by('id', $post->post_author);

        $user = [
            'name'     => $author->nickname,
            'bio'      => get_user_meta($author->ID, 'description', true) ?? '',
            'twitter'  => get_user_meta($author->ID, 'twitter', true) ?? '',
            'facebook' => get_user_meta($author->ID, 'facebook', true) ?? '',
            'linkedin' => get_user_meta($author->ID, 'linkedin', true) ?? '',
        ];

        return $content . $this->markup($user);
    }

    public function enqueueStyleSheet()
    {
        wp_enqueue_style('alexandra-author-bio', ALEXANDRA_URL . 'assets/css/author_bio.css');
    }

    public function deactivate()
    {
        // TODO: Implement deactivate() method.
    }

    public function uninstall()
    {
        // TODO: Implement uninstall() method.
    }
}
