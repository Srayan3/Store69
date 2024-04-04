<?php
include '../conn.php';
?>
<section style="padding: 15px">
    <table>
        <thead>
            <th onclick="window.location.href = 'new-category'" id="addNewItem" class="add_new_item" colspan="4" class="view_all">Add New Category</th>
        </thead>
        <thead>
            <th class="number category_table">Category ID</th>
            <th class="category_table">Category Name</th>
            <th class="category_table">Category Order</th>
            <th class="action_th category_table">Action</th>
        </thead>
        <tbody>
            <?php
            $select_category = "SELECT * FROM `categories` ORDER BY `category_order` ASC";
            $select_category_query = mysqli_query($conn, $select_category);
            $category_row = mysqli_num_rows($select_category_query);
            while($fetch_category = mysqli_fetch_array($select_category_query)){
            ?>
            <tr>
                <td class="number category_table">S69-Cat-<?php echo $fetch_category['category_id'] ?></td>
                <td class="category_table"><?php echo $fetch_category['category_name'] ?></td>
                <td class="category_table category_order_td">
                    <form action="category-order" method="post" id="<?php echo 'categoryId'.$fetch_category['category_id']; ?>">
                    <select name="categoryOrder" class="category_order" name="" id="">
                        <option selected value="<?php echo $fetch_category['category_order'] ?>"><?php echo $fetch_category['category_order'] ?></option>
                        <?php
                        for ($i=1; $i<=100; $i++) {
                            ?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <input type="hidden" name="category_id" value="<?php echo $fetch_category['category_id'] ?>">
                    </form>
                </td>
                <td onclick="document.getElementById('<?php echo 'categoryId'.$fetch_category['category_id']; ?>').submit()" class="order_proceed action_button_divs category_table">Proceed</td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</section>