<?php

require('../../../wp-config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $val = $_POST['term'];

    $args = [
        'post_type' => 'post',
        's' => $val
    ];
    $response = new WP_Query($args);

    if($response->have_posts()): while($response->have_posts()): $response->the_post();

        ?>
            <option id="post-<?= get_the_title() ?>" onclick="inputPost('<?= get_the_title() ?>')" value="<?= get_the_title() ?>"><?= get_the_title() ?></option>
        <?php

    endwhile; else: echo "0"; endif;
}

?>