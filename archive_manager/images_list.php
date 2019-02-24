<!-- Copyright: Jeremy Anderson 2018 -->
<?php include('../view/header.php'); ?>
<main>
  <h1>Archive Manager</h1>
  
  <aside>
    <h2>Navigation</h2>
    <?php include('../view/manager_navigation.php'); ?>
  </aside>
  
  <section>
    <h2>Images</h2>
    <table class="manager_list_table">
      <tr>
        <th>Filename</th>
        <th>Description</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php foreach ($images as $image) : ?>
      <tr>
        <td><?php echo $image->getFilename(); ?></td>
        <td><?php echo $image->getDescription(); ?></td>
        <td class="button">
          <form action="." method="post">
            <input type="hidden" name="action" value="show_edit_image_form">
            <input type="hidden" name="image_id" value="<?php echo $image->getID(); ?>">
            <input type="submit" value="Edit">
          </form>
        </td>
        <td class ="button">
          <form action="." method="post">
            <input type="hidden" name="action" value="show_delete_image_form">
            <input type="hidden" name="image_id" value="<?php echo $image->getID(); ?>">
            <input type="submit" value="Delete">
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
    <p><a href="?action=show_add_image_form">Add Image</a></p>
  </section>
</main>

<?php include('../view/footer.php'); ?>