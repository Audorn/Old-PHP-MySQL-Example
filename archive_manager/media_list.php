<!-- Copyright: Jeremy Anderson 2018 -->
<?php include('../view/header.php'); ?>
<main>
  <h1>Archive Manager</h1>
  
  <aside>
    <h2>Navigation</h2>
    <?php include('../view/manager_navigation.php'); ?>
  </aside>
  
  <section>
    <h2>Media</h2>
    <?php echo '<h1 style="color: maroon;">MEDIA TABLE DOES NOT EXIST IN DATABASE YET!</h1>'; ?>
    <table class="manager_list_table">
      <tr>
        <th>Title</th>
        <th>Year</th>
        <th>Source</th>
        <th>Description</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php foreach ($media as $med) : ?>
      <tr>
        <td><?php echo $med->getTitle(); ?></td>
        <td><?php echo $med->getYear(); ?></td>
        <td><?php echo $med->getSource(); ?></td>
        <td><?php echo $med->getDescription(); ?></td>
        <td class="button">
          <form action="." method="post">
            <input type="hidden" name="action" value="show_edit_media_form">
            <input type="hidden" name="media_id" value="<?php echo $med->getID(); ?>">
            <input type="submit" value="Edit">
          </form>
        </td>
        <td class ="button">
          <form action="." method="post">
            <input type="hidden" name="action" value="show_delete_media_form">
            <input type="hidden" name="media_id" value="<?php echo $med->getID(); ?>">
            <input type="submit" value="Delete">
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
    <p><a href="?action=show_add_media_form">Add Media</a></p>
  </section>
</main>

<?php include('../view/footer.php'); ?>