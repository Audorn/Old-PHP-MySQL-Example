<!-- Copyright: Jeremy Anderson 2018 -->
<?php include('../view/header.php'); ?>
<main>
  <h1>Archive Manager</h1>
  
  <aside>
    <h2>Navigation</h2>
    <?php include('../view/manager_navigation.php'); ?>
  </aside>
  
  <section>
    <h2>Real Companies</h2>
    <table class="manager_list_table">
      <tr>
        <th>Name</th>
        <th>Description</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php foreach ($realcompanies as $realcompany) : ?>
      <tr>
        <td>
          <a href="?action=<?php echo Action::view_realcompany; ?>&
          <?php echo VN::realcompany_id.'='.$realcompany->getID(); ?>">
            <?php echo $realcompany->getName(); ?>
          </a>
        </td>
        <td><?php echo $realcompany->getDescription(); ?></td>
        <td class="button">
          <form action="." method="post">
            <input type="hidden" name="<?php echo VN::action; ?>" value="<?php echo Action::show_edit_realcompany_form; ?>">
            <input type="hidden" name="<?php echo VN::realcompany_id; ?>" value="<?php echo $realcompany->getID(); ?>">
            <input type="submit" name="<?php echo VN::button; ?>" value="<?php echo BV::Edit; ?>">
          </form>
        </td>
        <td class="button">
          <form action="." method="post">
            <input type="hidden" name="<?php echo VN::action; ?>" value="<?php echo Action::show_delete_realcompany_form; ?>">
            <input type="hidden" name="<?php echo VN::realcompany_id; ?>" value="<?php echo $realcompany->getID(); ?>">
            <input type="submit" name="<?php echo VN::button; ?>" value="<?php echo BV::Delete; ?>">
          </form>
        </td>

      </tr>
      <?php endforeach; ?>
    </table>
    <p>
      <a href="?action=<?php echo Action::show_add_realcompany_form; ?>">
        Add Real Company
      </a>
    </p>
  </section>
</main>

<?php include('../view/footer.php'); ?>