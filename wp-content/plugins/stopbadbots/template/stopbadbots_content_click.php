<!DOCTYPE html>
<html>

<head>
    <?php wp_head(); ?>
</head>
<body>
    <div class="container" id="main-content">
        <style>
        .verticalhorizontal {
            width: 500px;
            height: 240px;
            top: 40%;
            /* left: 50%; */
            bottom: 50%;
            right: 50%;
            /* position: absolute;*/
            margin: auto;
            vertical-align: center;
            max-width: 90%;
            padding: 20px;
            border: 1px solid gray;
            margin: 0px auto;
            text-align: center;
            background-color: white;
            font-size: 20px;
            padding-bottom: 20px;
        }

        body {
            background-color: lightgray;
        }

        #recaptcha_for_all_button {
            padding: 20px;
            font-size: 16px;
        }


        </style>
        <?php define('LOGPLUGINURL2', plugin_dir_url(__file__));?>
        <div class="verticalhorizontal">
            <h3>Block Bots</h3>
            <br>
            Are you human?
            <br>
            <br>
            <form id="recaptcha_for_all" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="POST">
                <button id="recaptcha_for_all_button" name="recaptcha_for_all_button" type="submit">YES!</button>
            </form>
            <br>
            <br>
        </div>
    </div>
    <?php wp_footer(); ?>
</body>

</html>