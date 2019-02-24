<!-- Copyright: Jeremy Anderson 2018 -->
<?php include('../view/header.php'); ?>
<main>
  <h1>Archive Manager</h1>
  
  <aside>
    <h2>Navigation</h2>
    <?php include('../view/manager_navigation.php'); ?>
  </aside>
  
  <section>
    <h2>Real Persons</h2>
    <table class="manager_list_table">
      <tr>
        <th>Name</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php foreach ($realpersons as $realperson) : ?>
      <tr>
        <td><?php echo $realperson->getName(); ?></td>
        <td class="button">
          <form action="." method="post">
            <input type="hidden" name="action" value="show_edit_realperson_form">
            <input type="hidden" name="realperson_id" value="<?php echo $realperson->getID(); ?>">
            <input type="submit" value="Edit">
          </form>
        </td>
        <td class ="button">
          <form action="." method="post">
            <input type="hidden" name="action" value="show_delete_realperson_form">
            <input type="hidden" name="realperson_id" value="<?php echo $realperson->getID(); ?>">
            <input type="submit" value="Delete">
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
    <p><a href="?action=show_add_realperson_form">Add Real Person</a></p>
  </section>
</main>

<?php include('../view/footer.php'); ?>