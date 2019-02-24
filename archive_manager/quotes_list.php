<!-- Copyright: Jeremy Anderson 2018 -->
<?php include('../view/header.php'); ?>
<main>
  <h1>Archive Manager</h1>
  
  <aside>
    <h2>Navigation</h2>
    <?php include('../view/manager_navigation.php'); ?>
  </aside>
  
  <section>
    <h2>Quotes</h2>
    <table class="manager_list_table">
      <tr>
        <th>Quote</th>
        <th>Reasoning</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php foreach ($quotes as $quote) : ?>
      <tr>
        <td><?php echo $quote->getQuote(); ?></td>
        <td><?php echo $quote->getReasoning(); ?></td>
        <td class="button">
          <form action="." method="post">
            <input type="hidden" name="action" value="show_edit_quote_form">
            <input type="hidden" name="quote_id" value="<?php echo $quote->getID(); ?>">
            <input type="submit" value="Edit">
          </form>
        </td>
        <td class ="button">
          <form action="." method="post">
            <input type="hidden" name="action" value="show_delete_quote_form">
            <input type="hidden" name="quote_id" value="<?php echo $quote->getID(); ?>">
            <input type="submit" value="Delete">
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
    <p><a href="?action=show_add_quote_form">Add Quote</a></p>
  </section>
</main>

<?php include('../view/footer.php'); ?>