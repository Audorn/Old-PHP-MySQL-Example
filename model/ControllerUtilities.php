<?php
// Copyright: Jeremy Anderson 2018

// Valid variable names.
abstract class VN {
  const category_id = 'category_id';
  const category_ids = 'category_ids';
  const realcompany_id = 'realcompany_id';

  const parent_id = 'parent_id';
  const child_ids = 'child_ids';
  
  const name = 'name';
  const description = 'description';
  
  const action = 'action';
  const button = 'button';
  
  const invalid_input = 'invalid_input';
}

// Valid actions.
abstract class Action {
  const list_categories = 'list_categories';
  const view_category = 'view_category';
  const show_add_category_form = 'show_add_category_form';
  const add_category = 'add_category';
  const show_edit_category_form = 'show_edit_category_form';
  const edit_category = 'edit_category';
  const show_delete_category_form = 'show_delete_category_form';
  const delete_category = 'delete_category';
  
  const list_realcompanies = 'list_realcompanies';
  const view_realcompany = 'view_realcompany';
  const show_add_realcompany_form = 'show_add_realcompany_form';
  const add_realcompany = 'add_realcompany';
  const show_edit_realcompany_form = 'show_edit_realcompany_form';
  const edit_realcompany = 'edit_realcompany';
  const show_delete_realcompany_form = 'show_delete_realcompany_form';
  const delete_realcompany = 'delete_realcompany';

  const list_realpersons = 'list_realpersons';
  const list_books = 'list_books';
  const list_media = 'list_media';
  const list_quotes = 'list_quotes';
  const list_images = 'list_images';
}
?>