<?php

namespace Alexandra\App\Module;

use Alexandra\Base\Controller;

class AuthorBio extends Controller
{
    // frontend
//    jQuery.get('alexzandra_admin_ajax', function(data) {
//        console.log(data);
//    });




    public function register()
    {
        add_action('wp_ajax_alexzandra_admin_ajax', function () {
            // do stuffs

        });

        add_filter('user_contactmethods', [ $this, 'socialMetaFieldToUserProfile' ]);
        add_filter('the_content', [ $this, 'addAuthorBioToPost' ]);
        add_action('wp_enqueue_scripts', [$this, 'enqueueStyleSheet']);

    }

    public function socialMetaFieldToUserProfile($methods)
    {

        $methods['twitter'] = 'Twitter';
        $methods['facebook'] = 'Facebook';
        $methods['linkedin'] = 'LinkedIn';

        return $methods;
    }

    public function markup()
    {
        $data = '
                <div class="content">
                  <div class="card">
                    <div class="firstinfo"><img src="https://randomuser.me/api/portraits/lego/6.jpg"/>
                      <div class="profileinfo">
                        <h1>Francesco Moustache</h1>
                        <h3>Python Ninja</h3>
                        <p class="bio">Lived all my life on the top of mount Fuji, learning the way to be a Ninja Dev.</p>
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
        return $content . $this->markup();
    }

    public function enqueueStyleSheet()
    {
        wp_enqueue_style('alexandra-author-bio', ALEXANDRA_URL . 'assets/css/author_bio.css');
    }
}
