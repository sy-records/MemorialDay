<?php

if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit();
}

delete_option('memorial_day_options');
