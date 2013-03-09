<?php
if(!class_exists(JQuery_UI_Autocomplete_WP_JSON_API)){
  class JQuery_UI_Autocomplete_WP_JSON_API{

    function __construct(){
      if(!empty($_GET['data'])){
        require('../../../../wp-load.php');
        $data_output = array();
        $datasets = explode(' ', $_GET['data']);
        foreach($datasets as $data){
          if(method_exists($this, $data)){
            $dataset = $this->$data($_GET['term'], $_GET['style']);
            $data_output = array_merge($data_output, $dataset);
          }
        }
        if(!empty($data_output)){
          header('Content-Type: application/json');
          echo json_encode($data_output);
        }else{
          header($_SERVER['SERVER_PROTOCOL'] . '204 No Content', true, 204);
        }
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
      return $tag_names;
    }

    private function categories($term, $style){
      $category_names = array();
      $categories = get_categories();
      $match = $style === 'lookup' ? "/^$term/" : "/$term/";
      foreach($categories as $category){
        if(preg_match($match, $category->name)){
          array_push($category_names, $category->name);
        }
      }
      return $category_names;
    }

    private function post_titles($term, $style){
      $all_post_titles = array();
      $post_id_query = new WP_Query(array('post_type' => 'any', 'posts_per_page' => -1, 'fields' => 'ids'));
      $match = $style === 'lookup' ? "/^$term/" : "/$term/";
      foreach($post_id_query->posts as $id){
        if(preg_match($match, get_the_title($id))){
          array_push($all_post_titles, get_the_title($id));
        }
      }
      return $all_post_titles;
    }

    private function users($role, $term, $style){
      $user_names = array();
      $user_query = new WP_User_Query(array('role' => $role));
      $match = $style === 'lookup' ? "/^$term/" : "/$term/";
      foreach($user_query->results as $user){
        if(preg_match($match, $user->data->display_name)){
          array_push($user_names, $user->data->display_name);
        }
      }
      return $user_names;
    }

    private function authors($term, $style){
      return $this->users('Author', $term, $style);
    }

    private function contributors($term, $style){
      return $this->users('Contributor', $term, $style);
    }

    private function editors($term){
      return $this->users('Editor', $term, $style);
    }
  }
}
