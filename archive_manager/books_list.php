<!-- Copyright: Jeremy Anderson 2018 -->
<?php include('../view/header.php'); ?>
<main>
  <h1>Archive Manager</h1>
  
  <aside>
    <h2>Navigation</h2>
    <?php include('../view/manager_navigation.php'); ?>
  </aside>
  
  <section>
    <h2>Books</h2>
    <table class="manager_list_table">
      <tr>
        <th>Name</th>
        <th>Version</th>
        <th>Year</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php foreach ($books as $book) : ?>
      <tr>
        <td><?php echo $book->getTitle(); ?></td>
        <td><?php echo $book->getVersion(); ?></td>
        <td><?php echo $book->getYear(); ?></td>
        <td class="button">
          <form action="." method="post">
            <input type="hidden" name="action" value="show_edit_book_form">
            <input type="hidden" name="book_id" value="<?php echo $book->getID(); ?>">
            <input type="submit" value="Edit">
          </form>
        </td>
        <td class ="button">
          <form action="." method="post">
            <input type="hidden" name="action" value="show_delete_book_form">
            <input type="hidden" name="book_id" value="<?php echo $book->getID(); ?>">
            <input type="submit" value="Delete">
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
    <p><a href="?action=show_add_book_form">Add Book</a></p>
  </section>
</main>

<?php include('../view/footer.php'); ?>