<?php

namespace Alexandra\App\Module;

use Alexandra\Base\Controller;

class AuthorBio extends Controller
{
    public function register()
    {
        $settings = get_option(MODULE_SETTINGS_SLUG);

        if(!isset($settings ['author_bio']) || !$settings ['author_bio']) {
            return;
        }

        add_filter('user_contactmethods', [$this, 'socialMetaFieldToUserProfile']);
        add_filter('the_content', [$this, 'addAuthorBioToPost']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueStyleSheet']);
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
                        <h1>'. $user['name'] .'</h1>
                        <p class="bio">'. $user['bio'] .'</p>
                      </div>
                    </div>
                  </div>
                  <div class="badgescard">
                    <span class="devicons devicons-django"></span>
                    <span class="devicons devicons-python"> </span>
                    <span class="devicons devicons-codepen"></span>
                    <span class="devicons devicons-javascript_badge"></span>
                    <span class="devicons devicons-gulp"></span>
                    <span class="devicons devicons-angular"></span>
                    <span class="devicons devicons-sass"> </span>
                  </div>
                </div>
        ';

        return $data;
    }

    public function addAuthorBioToPost($content)
    {
        $user = get_user_by('id', get_the_author_meta('ID'));
        return $content . $this->markup($user);
    }

    public function enqueueStyleSheet()
    {
        $this->styles = [
            [
                'handle' => 'author',
                'src' => $this->assets->getStyleSheet('author_bio.css'),
                'media' => 'all',
            ],
        ];
        //wp_enqueue_style('alexandra-author-bio', ALEXANDRA_URL . 'assets/css/author_bio.css');
    }
}
