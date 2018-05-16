## How to make the Eduma Theme Compatibile with Give

1. If you are using Avada theme then you will get following issues:
    1. Donation amount set to 0.
    2. Sequential ID does not set.

    Note: Mainly this issue appears on Dreamhost when memcached enabled [Read More](https://github.com/WordImpress/Give/issues/3199).

    To fix this issue add this custom below function to your child theme's functions.php or add to this plugin https://wordpress.org/plugins/my-custom-functions/:

    ```
    function fusion_flush_object_cache(){}
    ```
