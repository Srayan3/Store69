<?php
include '../conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/sidepanel.css">
    <title>Admin Panel</title>
</head>
<body>
    <div class="sidepanel">
        <?php include './sidepanel.php' ?>
    </div>
    <div class="container">
        <div class="top">
            <h2>Dashboard</h2>
        </div>
        <div class="secondpart">
            <section style="padding: 15px; width: 100%">
            <?php
            $select_category = "SELECT * FROM `categories` WHERE `category_type`='classic' ORDER BY `category_order` ASC";
            $select_category_query = mysqli_query($conn, $select_category);
            $category_row = mysqli_num_rows($select_category_query);
            while($fetch_category = mysqli_fetch_array($select_category_query)){
            ?>
                <div class="category_parent">
                    <div class="category"><h3><?php echo $fetch_category['category_name'] ?></h3><button id="<?php echo 'expand_btn'.$fetch_category['category_id'] ?>" onclick="<?php echo 'expand'.$fetch_category['category_id'].'()' ?>"><svg class="navigator-buttons arrow_button_svg_pp" style="color: white;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 cursor-pointer"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"></path></svg></button></div>
                    <div id="<?php echo 'product_parent_parent_parent'.$fetch_category['category_id'] ?>" class="product_parent_parent_parent">
                        <?php
                        $category_id = $fetch_category['category_id'];
                        $select_product_parent = "SELECT * FROM `parent_product` WHERE `parent_product_category`='$category_id'";
                        $select_product_parent_query = mysqli_query($conn, $select_product_parent);
                        $product_parent_row = mysqli_num_rows($select_product_parent_query);
                        while($fetch_product_parent = mysqli_fetch_array($select_product_parent_query)){
                        ?>
                        <div class="product_parent_parent">
                            <div class="blank_parent">
                                <div class="blank_one">
                                    <div class="blank_one_child_one"></div>
                                    <div class="blank_one_child_two"></div>
                                </div>
                                <div class="blank_two">
                                    <div class="blank_two_child_one"></div>
                                    <div class="blank_two_child_two"></div>
                                </div>
                            </div>
                            <div class="product_parent">
                                <div class="product_parent_child">
                                    <p class="product_parent_name"><?php echo $fetch_product_parent['parent_product_name'] ?></p>
                                    <div class="actions_parent">
                                    <div class="actions">
                                        <div class="star_div">
                                            <form action="add-to-collection" method="post">
                                                <?php
                                                $pp_id = $fetch_product_parent['parent_product_id'];
                                                $select_collection = "SELECT * FROM `collection` WHERE `collection_item_id`='$pp_id'";
                                                $select_collection_query = mysqli_query($conn, $select_collection);
                                                $collection_row = mysqli_num_rows($select_collection_query);
                                                $fetch_collection = mysqli_fetch_array($select_collection_query);
                                                if($collection_row<1){
                                                ?>
                                                <input name="parent_product_id" type="hidden" value="<?php echo $fetch_product_parent['parent_product_id'] ?>">
                                                <input name="action" type="hidden" value="add">
                                                <button class="action_buttons">
                                                    <svg type="submit" class="star_svg" fill="#FFD91F" width="45px" height="45px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M11.4434703,19.4783366 L7.11534027,21.8561884 C6.53071469,22.1773786 5.80762087,21.9424899 5.50026501,21.3315498 C5.3778743,21.0882703 5.3356403,20.8096129 5.38010133,20.5387172 L6.2067006,15.5023462 C6.27323987,15.0969303 6.14461904,14.6832584 5.86275418,14.3961413 L2.36122346,10.8293635 C1.88825143,10.3475782 1.87857357,9.55633639 2.33960735,9.06207547 C2.52319342,8.86525818 2.76374635,8.73717345 3.02402575,8.69765029 L7.8630222,7.96285367 C8.25254987,7.90370429 8.58928356,7.64804097 8.76348563,7.27918144 L10.9275506,2.69693973 C11.2198634,2.07798981 11.936976,1.82386417 12.5292664,2.12933421 C12.7651196,2.25097399 12.9560234,2.45047063 13.0724239,2.69693973 L15.2364889,7.27918144 C15.410691,7.64804097 15.7474247,7.90370429 16.1369524,7.96285367 L20.9759488,8.69765029 C21.6295801,8.79690353 22.0824579,9.43108706 21.9874797,10.1141388 C21.9496589,10.3861337 21.827091,10.6375141 21.6387511,10.8293635 L18.1372204,14.3961413 C17.8553555,14.6832584 17.7267347,15.0969303 17.793274,15.5023462 L18.6198732,20.5387172 C18.7315268,21.219009 18.2943081,21.8650816 17.6433179,21.9817608 C17.3840902,22.028223 17.1174353,21.984088 16.8846343,21.8561884 L12.5565043,19.4783366 C12.2081001,19.2869252 11.7918744,19.2869252 11.4434703,19.4783366 Z M10.4804474,17.7254569 C11.4285912,17.2045517 12.5713833,17.2045517 13.5195271,17.7254569 L16.3902376,19.3026102 L15.819679,15.8262644 C15.6504974,14.7954609 15.9786587,13.7400243 16.7100131,12.9950419 L19.2066263,10.4519072 L15.8366964,9.9401868 C14.7818036,9.78000242 13.8837002,9.09812209 13.4280265,8.13326784 L11.9999873,5.10950433 L10.5719481,8.13326784 C10.1162743,9.09812209 9.21817098,9.78000242 8.1632782,9.9401868 L4.79334826,10.4519072 L7.28996143,12.9950419 C8.02131584,13.7400243 8.34947716,14.7954609 8.18029555,15.8262644 L7.60973692,19.3026102 L10.4804474,17.7254569 Z"/>
                                                        <path class="hover" fill-rule="evenodd" d="M11.4434703,19.4783366 L7.11534027,21.8561884 C6.53071469,22.1773786 5.80762087,21.9424899 5.50026501,21.3315498 C5.3778743,21.0882703 5.3356403,20.8096129 5.38010133,20.5387172 L6.2067006,15.5023462 C6.27323987,15.0969303 6.14461904,14.6832584 5.86275418,14.3961413 L2.36122346,10.8293635 C1.88825143,10.3475782 1.87857357,9.55633639 2.33960735,9.06207547 C2.52319342,8.86525818 2.76374635,8.73717345 3.02402575,8.69765029 L7.8630222,7.96285367 C8.25254987,7.90370429 8.58928356,7.64804097 8.76348563,7.27918144 L10.9275506,2.69693973 C11.2198634,2.07798981 11.936976,1.82386417 12.5292664,2.12933421 C12.7651196,2.25097399 12.9560234,2.45047063 13.0724239,2.69693973 L15.2364889,7.27918144 C15.410691,7.64804097 15.7474247,7.90370429 16.1369524,7.96285367 L20.9759488,8.69765029 C21.6295801,8.79690353 22.0824579,9.43108706 21.9874797,10.1141388 C21.9496589,10.3861337 21.827091,10.6375141 21.6387511,10.8293635 L18.1372204,14.3961413 C17.8553555,14.6832584 17.7267347,15.0969303 17.793274,15.5023462 L18.6198732,20.5387172 C18.7315268,21.219009 18.2943081,21.8650816 17.6433179,21.9817608 C17.3840902,22.028223 17.1174353,21.984088 16.8846343,21.8561884 L12.5565043,19.4783366 C12.2081001,19.2869252 11.7918744,19.2869252 11.4434703,19.4783366 Z M10.4804474,17.7254569 C11.4285912,17.2045517 12.5713833,17.2045517 13.5195271,17.7254569 L16.3902376,19.3026102 L15.819679,15.8262644 C15.6504974,14.7954609 15.9786587,13.7400243 16.7100131,12.9950419 L19.2066263,10.4519072 L15.8366964,9.9401868 C14.7818036,9.78000242 13.8837002,9.09812209 13.4280265,8.13326784 L11.9999873,5.10950433 L10.5719481,8.13326784 C10.1162743,9.09812209 9.21817098,9.78000242 8.1632782,9.9401868 L4.79334826,10.4519072 L7.28996143,12.9950419 C8.02131584,13.7400243 8.34947716,14.7954609 8.18029555,15.8262644 L7.60973692,19.3026102 L10.4804474,17.7254569 Z"/>
                                                        <rect class="hover" x="7.461" y="8.083" width="9.022" height="11.226" style="stroke: rgb(0, 0, 0); stroke-width: 0px;"/>
                                                        <path class="hover" d="M 12.029 4.961 L 14.076 8.283 L 9.981 8.283 L 12.029 4.961 Z" style="stroke: rgb(0, 0, 0); stroke-width: 0px;" bx:shape="triangle 9.981 4.961 4.095 3.322 0.5 0 1@f7bd6abf"/>
                                                        <path class="hover" d="M 15.061 10.695 Q 20.478 8.007 20.478 10.695 L 20.478 10.695 Q 20.478 13.382 15.061 13.382 L 15.061 13.382 Q 9.643 13.382 15.061 10.695 Z" style="stroke: rgb(0, 0, 0); stroke-width: 0px;" bx:shape="triangle 9.643 8.007 10.835 5.375 1 0.5 1@ff4a975a"/>
                                                        <path class="hover" d="M 3.638 10.59 Q 3.638 7.903 9.056 10.59 L 9.056 10.59 Q 14.473 13.278 9.056 13.278 L 9.056 13.278 Q 3.638 13.278 3.638 10.59 Z" style="stroke: rgb(0, 0, 0); stroke-width: 0px;" bx:shape="triangle 3.638 7.903 10.835 5.375 0 0.5 1@2e614d3e"/>
                                                    </svg>
                                                </button>
                                                <?php
                                                }else { ?>
                                                <input name="parent_product_id" type="hidden" value="<?php echo $fetch_product_parent['parent_product_id'] ?>">
                                                <input name="action" type="hidden" value="remove">
                                                <button class="action_buttons hover_n_btn">
                                                    <svg type="submit" class="star_svg" fill="#FFD91F" width="45px" height="45px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M11.4434703,19.4783366 L7.11534027,21.8561884 C6.53071469,22.1773786 5.80762087,21.9424899 5.50026501,21.3315498 C5.3778743,21.0882703 5.3356403,20.8096129 5.38010133,20.5387172 L6.2067006,15.5023462 C6.27323987,15.0969303 6.14461904,14.6832584 5.86275418,14.3961413 L2.36122346,10.8293635 C1.88825143,10.3475782 1.87857357,9.55633639 2.33960735,9.06207547 C2.52319342,8.86525818 2.76374635,8.73717345 3.02402575,8.69765029 L7.8630222,7.96285367 C8.25254987,7.90370429 8.58928356,7.64804097 8.76348563,7.27918144 L10.9275506,2.69693973 C11.2198634,2.07798981 11.936976,1.82386417 12.5292664,2.12933421 C12.7651196,2.25097399 12.9560234,2.45047063 13.0724239,2.69693973 L15.2364889,7.27918144 C15.410691,7.64804097 15.7474247,7.90370429 16.1369524,7.96285367 L20.9759488,8.69765029 C21.6295801,8.79690353 22.0824579,9.43108706 21.9874797,10.1141388 C21.9496589,10.3861337 21.827091,10.6375141 21.6387511,10.8293635 L18.1372204,14.3961413 C17.8553555,14.6832584 17.7267347,15.0969303 17.793274,15.5023462 L18.6198732,20.5387172 C18.7315268,21.219009 18.2943081,21.8650816 17.6433179,21.9817608 C17.3840902,22.028223 17.1174353,21.984088 16.8846343,21.8561884 L12.5565043,19.4783366 C12.2081001,19.2869252 11.7918744,19.2869252 11.4434703,19.4783366 Z M10.4804474,17.7254569 C11.4285912,17.2045517 12.5713833,17.2045517 13.5195271,17.7254569 L16.3902376,19.3026102 L15.819679,15.8262644 C15.6504974,14.7954609 15.9786587,13.7400243 16.7100131,12.9950419 L19.2066263,10.4519072 L15.8366964,9.9401868 C14.7818036,9.78000242 13.8837002,9.09812209 13.4280265,8.13326784 L11.9999873,5.10950433 L10.5719481,8.13326784 C10.1162743,9.09812209 9.21817098,9.78000242 8.1632782,9.9401868 L4.79334826,10.4519072 L7.28996143,12.9950419 C8.02131584,13.7400243 8.34947716,14.7954609 8.18029555,15.8262644 L7.60973692,19.3026102 L10.4804474,17.7254569 Z"/>
                                                        <path class="hover_n" fill-rule="evenodd" d="M11.4434703,19.4783366 L7.11534027,21.8561884 C6.53071469,22.1773786 5.80762087,21.9424899 5.50026501,21.3315498 C5.3778743,21.0882703 5.3356403,20.8096129 5.38010133,20.5387172 L6.2067006,15.5023462 C6.27323987,15.0969303 6.14461904,14.6832584 5.86275418,14.3961413 L2.36122346,10.8293635 C1.88825143,10.3475782 1.87857357,9.55633639 2.33960735,9.06207547 C2.52319342,8.86525818 2.76374635,8.73717345 3.02402575,8.69765029 L7.8630222,7.96285367 C8.25254987,7.90370429 8.58928356,7.64804097 8.76348563,7.27918144 L10.9275506,2.69693973 C11.2198634,2.07798981 11.936976,1.82386417 12.5292664,2.12933421 C12.7651196,2.25097399 12.9560234,2.45047063 13.0724239,2.69693973 L15.2364889,7.27918144 C15.410691,7.64804097 15.7474247,7.90370429 16.1369524,7.96285367 L20.9759488,8.69765029 C21.6295801,8.79690353 22.0824579,9.43108706 21.9874797,10.1141388 C21.9496589,10.3861337 21.827091,10.6375141 21.6387511,10.8293635 L18.1372204,14.3961413 C17.8553555,14.6832584 17.7267347,15.0969303 17.793274,15.5023462 L18.6198732,20.5387172 C18.7315268,21.219009 18.2943081,21.8650816 17.6433179,21.9817608 C17.3840902,22.028223 17.1174353,21.984088 16.8846343,21.8561884 L12.5565043,19.4783366 C12.2081001,19.2869252 11.7918744,19.2869252 11.4434703,19.4783366 Z M10.4804474,17.7254569 C11.4285912,17.2045517 12.5713833,17.2045517 13.5195271,17.7254569 L16.3902376,19.3026102 L15.819679,15.8262644 C15.6504974,14.7954609 15.9786587,13.7400243 16.7100131,12.9950419 L19.2066263,10.4519072 L15.8366964,9.9401868 C14.7818036,9.78000242 13.8837002,9.09812209 13.4280265,8.13326784 L11.9999873,5.10950433 L10.5719481,8.13326784 C10.1162743,9.09812209 9.21817098,9.78000242 8.1632782,9.9401868 L4.79334826,10.4519072 L7.28996143,12.9950419 C8.02131584,13.7400243 8.34947716,14.7954609 8.18029555,15.8262644 L7.60973692,19.3026102 L10.4804474,17.7254569 Z"/>
                                                        <rect class="hover_n" x="7.461" y="8.083" width="9.022" height="11.226" style="stroke: rgb(0, 0, 0); stroke-width: 0px;"/>
                                                        <path class="hover_n" d="M 12.029 4.961 L 14.076 8.283 L 9.981 8.283 L 12.029 4.961 Z" style="stroke: rgb(0, 0, 0); stroke-width: 0px;" bx:shape="triangle 9.981 4.961 4.095 3.322 0.5 0 1@f7bd6abf"/>
                                                        <path class="hover_n" d="M 15.061 10.695 Q 20.478 8.007 20.478 10.695 L 20.478 10.695 Q 20.478 13.382 15.061 13.382 L 15.061 13.382 Q 9.643 13.382 15.061 10.695 Z" style="stroke: rgb(0, 0, 0); stroke-width: 0px;" bx:shape="triangle 9.643 8.007 10.835 5.375 1 0.5 1@ff4a975a"/>
                                                        <path class="hover_n" d="M 3.638 10.59 Q 3.638 7.903 9.056 10.59 L 9.056 10.59 Q 14.473 13.278 9.056 13.278 L 9.056 13.278 Q 3.638 13.278 3.638 10.59 Z" style="stroke: rgb(0, 0, 0); stroke-width: 0px;" bx:shape="triangle 3.638 7.903 10.835 5.375 0 0.5 1@2e614d3e"/>
                                                    </svg>
                                                </button>
                                                <?php
                                                }
                                                ?>
                                            </form>
                                        </div>
                                        <div class="trashcan_div">
                                            <form action="delete-parent-product" method="post">
                                                <input name="parent_product_id" type="hidden" value="<?php echo $fetch_product_parent['parent_product_id'] ?>">
                                                <button class="action_buttons">
                                                    <svg width="45px" height="45px" xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 456 511.82"><path fill="#FD3B3B" d="M48.42 140.13h361.99c17.36 0 29.82 9.78 28.08 28.17l-30.73 317.1c-1.23 13.36-8.99 26.42-25.3 26.42H76.34c-13.63-.73-23.74-9.75-25.09-24.14L20.79 168.99c-1.74-18.38 9.75-28.86 27.63-28.86zM24.49 38.15h136.47V28.1c0-15.94 10.2-28.1 27.02-28.1h81.28c17.3 0 27.65 11.77 27.65 28.01v10.14h138.66c.57 0 1.11.07 1.68.13 10.23.93 18.15 9.02 18.69 19.22.03.79.06 1.39.06 2.17v42.76c0 5.99-4.73 10.89-10.62 11.19-.54 0-1.09.03-1.63.03H11.22c-5.92 0-10.77-4.6-11.19-10.38 0-.72-.03-1.47-.03-2.23v-39.5c0-10.93 4.21-20.71 16.82-23.02 2.53-.45 5.09-.37 7.67-.37zm83.78 208.38c-.51-10.17 8.21-18.83 19.53-19.31 11.31-.49 20.94 7.4 21.45 17.57l8.7 160.62c.51 10.18-8.22 18.84-19.53 19.32-11.32.48-20.94-7.4-21.46-17.57l-8.69-160.63zm201.7-1.74c.51-10.17 10.14-18.06 21.45-17.57 11.32.48 20.04 9.14 19.53 19.31l-8.66 160.63c-.52 10.17-10.14 18.05-21.46 17.57-11.31-.48-20.04-9.14-19.53-19.32l8.67-160.62zm-102.94.87c0-10.23 9.23-18.53 20.58-18.53 11.34 0 20.58 8.3 20.58 18.53v160.63c0 10.23-9.24 18.53-20.58 18.53-11.35 0-20.58-8.3-20.58-18.53V245.66z"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="product_parent_parent">
                            <div class="blank_parent">
                                <div class="blank_one">
                                    <div class="blank_one_child_one"></div>
                                    <div class="blank_one_child_two"></div>
                                </div>
                                <div class="blank_two">
                                    <div class="blank_two_child_one"></div>
                                    <div class="blank_two_child_two"></div>
                                </div>
                            </div>
                            <div class="product_parent">
                                <div class="product_parent_child new_cat">
                                    <form action="./new-parent-product" method="post">
                                        <input type="hidden" value="<?php echo $fetch_category['category_id'] ?>" name="category_id">
                                        <button>Add New Product Parent</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
                ?>
            </section>
        </div>
    </div>
    <script>
        <?php
        $select_category_script = "SELECT * FROM `categories` WHERE `category_type`='classic' ORDER BY `category_order` ASC";
        $select_category_script_query = mysqli_query($conn, $select_category_script);
        $category_row = mysqli_num_rows($select_category_script_query);
        while($fetch_category_script = mysqli_fetch_array($select_category_script_query)){
        ?>
        function <?php echo 'expand'.$fetch_category_script['category_id'].'()' ?>{
            <?php
            $category_id2 = $fetch_category_script['category_id'];
            $select_product_parent2 = "SELECT * FROM `parent_product` WHERE `parent_product_category`='$category_id2'";
            $select_product_parent_query2 = mysqli_query($conn, $select_product_parent2);
            $product_parent_row2 = mysqli_num_rows($select_product_parent_query2);  
            ?>
            <?php
            $rows = $product_parent_row2;
            $pixel = 100;
            $sum = 120;
            $math_multiply = $rows * $pixel;
            $math_sum = $math_multiply + $sum;
            ?>
            document.getElementById('<?php echo 'expand_btn'.$fetch_category_script['category_id'] ?>').style.rotate = "-90deg";
            document.getElementById('<?php echo 'expand_btn'.$fetch_category_script['category_id'] ?>').setAttribute("onclick","<?php echo 'collaps'.$fetch_category_script['category_id'].'()' ?>");
            document.getElementById('<?php echo 'product_parent_parent_parent'.$fetch_category_script['category_id'] ?>').style.height = "<?php echo $math_sum.'px' ?>";
        }
        function <?php echo 'collaps'.$fetch_category_script['category_id'].'()' ?>{
            <?php
            $category_id2 = $fetch_category_script['category_id'];
            $select_product_parent2 = "SELECT * FROM `parent_product` WHERE `parent_product_category`='$category_id2'";
            $select_product_parent_query2 = mysqli_query($conn, $select_product_parent2);
            $product_parent_row2 = mysqli_num_rows($select_product_parent_query2);  
            ?>
            document.getElementById('<?php echo 'expand_btn'.$fetch_category_script['category_id'] ?>').style.rotate = "90deg";
            document.getElementById('<?php echo 'expand_btn'.$fetch_category_script['category_id'] ?>').setAttribute("onclick","<?php echo 'expand'.$fetch_category_script['category_id'].'()' ?>");
            document.getElementById('<?php echo 'product_parent_parent_parent'.$fetch_category_script['category_id'] ?>').style.height = "0px";
        }
        <?php
        }
        ?>
    </script>
</body>
</html>