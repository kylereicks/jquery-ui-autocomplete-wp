<?php
if(!class_exists(JQuery_UI_Autocomplete_WP_JSON_API)){
  class JQuery_UI_Autocomplete_WP_JSON_API{

    function __construct(){
      if(!empty($_GET['data']) && method_exists($this, $_GET['data'])){
        require('../../../../wp-load.php');
        header('Content-Type: application/json');
        echo $this->$_GET['data']($_GET['term'], $_GET['style']);
      }
    }

    private function tags($term, $style){
      $tag_names = array();
      $tags = get_tags();
      $match = $style === 'lookup' ? "/^$term/" : "/$term/";
      foreach($tags as $tag){
        if(preg_match($match, $tag->name)){
          array_push($tag_names, $tag->name);
        }
      }
      return json_encode($tag_names);
    }

    private function categories($term){
      $category_names = array();
      $categories = get_categories();
      foreach($categories as $category){
        if(preg_match("/^$term/", $category->name)){
          array_push($category_names, $category->name);
        }
      }
      return json_encode($category_names);
    }

    private function post_titles($term){
      $all_post_titles = array();
      $post_id_query = new WP_Query(array('post_type' => 'any', 'posts_per_page' => -1, 'fields' => 'ids'));
      foreach($post_id_query->posts as $id){
        if(preg_match("/^$term/", get_the_title($id))){
          array_push($all_post_titles, get_the_title($id));
        }
      }
      return json_encode($all_post_titles);
    }

    private function users($role, $term){
      $user_names = array();
      $user_query = new WP_User_Query(array('role' => $role));
      foreach($user_query->results as $user){
        if(preg_match("/^$term/", $user->data->display_name)){
          array_push($user_names, $user->data->display_name);
        }
      }
      return json_encode($user_names);
    }

    private function authors($term){
      return $this->users('Author', $term);
    }

    private function contributors($term){
      return $this->users('Contributor', $term);
    }

    private function editors($term){
      return $this->users('Editor', $term);
    }
  }
}
