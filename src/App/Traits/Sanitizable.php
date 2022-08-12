<?php

namespace Alexandra\App\Traits;

trait Sanitizable
{
    public function sanitizeCheckBox($input)
    {
        $fieldList = [
            'cpt_settings' => 'Activate CPT Manager',
            'taxonomy_settings' => 'Activate Taxonomy Manager',
            'widget_settings' => 'Activate Widget Manager',
            'gallery_settings' => 'Activate Gallery Manager',
            'testimonial_settings' => 'Activate Testimonial Manager',
            'template_settings' => 'Activate Template Manager',
            'login_settings' => 'Activate Login Manager',
            'membership_settings' => 'Activate Membership Manager',
            'chat_settings' => 'Activate Chat Manager',
        ];

        $output = [];

        foreach ($fieldList as $key => $value) {
            $output[$key] = isset($input[$key]) ? 1 : 0;
        }

        return $output;
    }
}
