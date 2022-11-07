<?php
    class BlogModel extends DB{
        public function getList(){
            $query = 'SELECT * FROM blogs order by updated_at DESC';
            $result = $this->con->query($query);
            $arr = array();
            if($result->rowCount() > 0){
                while($row_blog_item = $result->fetch()){
                    $blog_id = $row_blog_item['id'];
                    //add cat_name
                    $row_blog_item['cat_name'] = array();
                    $query_select_blog_categoryofblog = "SELECT * FROM blog_categoryofblog where blog_id = '$blog_id'";
                    $result_select_blog_categoryofblog = $this->con->query($query_select_blog_categoryofblog);
                    if($result_select_blog_categoryofblog->rowCount() > 0 ){
                        while($row_blog_categoryoblog = $result_select_blog_categoryofblog->fetch()){
                            $cat_id = $row_blog_categoryoblog['cat_id'];
//                            echo "cat_id = ".$cat_id;
                            $query_select_to_get_name_category = "SELECT * FROM category_of_blog WHERE id = '$cat_id'";
                            $result_select_to_get_name_category = $this->con->query($query_select_to_get_name_category);
                            if($result_select_to_get_name_category->rowCount() > 0){
                                $row_select_to_get_name_category = $result_select_to_get_name_category->fetch();
                                array_push($row_blog_item['cat_name'],$row_select_to_get_name_category['name']);
                            }
                        }
                    }
                    //add tags_name
                    $row_blog_item['tags_name'] =  array();
                    $query_select_tags = "SELECT * FROM blog_tags WHERE blog_id = '$blog_id'";
                    $result_select_tags = $this->con->query($query_select_tags);
                    if($result_select_tags->rowCount()){
                        while($row_blog_tags = $result_select_tags->fetch()){
                            $tags_id = $row_blog_tags['tags_id'];

                            $query_select_to_get_name_tags = "SELECT * FROM tags where id = '$tags_id'";
                            $result_select_to_get_name_tags = $this->con->query($query_select_to_get_name_tags);
                            if($result_select_to_get_name_tags->rowCount() > 0){
                                $row_select_to_get_name_tags = $result_select_to_get_name_tags->fetch();
                                array_push($row_blog_item['tags_name'],$row_select_to_get_name_tags['name']);
                            }
                        }
                    }
                    array_push($arr,$row_blog_item);
                }
            }
            return json_encode($arr);
        }

        public function getList_limit(){
            $query = 'SELECT * FROM blogs order by updated_at DESC LIMIT 8';
            $result = $this->con->query($query);
            $arr = array();
            if($result->rowCount()){
                while($row_blog_item = $result->fetch()){
                    $blog_id = $row_blog_item['id'];
                    //add cat_name
                    $row_blog_item['cat_name'] = array();
                    $query_select_blog_categoryofblog = "SELECT * FROM blog_categoryofblog where blog_id = '$blog_id'";
                    $result_select_blog_categoryofblog = $this->con->query($query_select_blog_categoryofblog);
                    if($result_select_blog_categoryofblog->rowCount() > 0){
                        while($row_blog_categoryoblog = $result_select_blog_categoryofblog->fetch()){
                            $cat_id = $row_blog_categoryoblog['cat_id'];
//                            echo "cat_id = ".$cat_id;
                            $query_select_to_get_name_category = "SELECT * FROM category_of_blog WHERE id = '$cat_id'";
                            $result_select_to_get_name_category = $this->con->query($query_select_to_get_name_category);
                            if($result_select_to_get_name_category->rowCount() > 0){
                                $row_select_to_get_name_category = $result_select_to_get_name_category->fetch();
                                array_push($row_blog_item['cat_name'],$row_select_to_get_name_category['name']);
                            }
                        }
                    }
                    //add tags_name
                    $row_blog_item['tags_name'] =  array();
                    $query_select_tags = "SELECT * FROM blog_tags WHERE blog_id = '$blog_id'";
                    $result_select_tags = $this->con->query($query_select_tags);
                    if($result_select_tags->rowCount() > 0){
                        while($row_blog_tags = $result_select_tags->fetch()){
                            $tags_id = $row_blog_tags['tags_id'];

                            $query_select_to_get_name_tags = "SELECT * FROM tags where id = '$tags_id'";
                            $result_select_to_get_name_tags = $this->con->query($query_select_to_get_name_tags);
                            if($result_select_to_get_name_tags->rowCount() > 0){
                                $row_select_to_get_name_tags = $result_select_to_get_name_tags->fetch();
                                array_push($row_blog_item['tags_name'],$row_select_to_get_name_tags['name']);
                            }
                        }
                    }
                    array_push($arr,$row_blog_item);
                }
            }
            return json_encode($arr);
        }

        public function insert($cat_id,$tags_id,$title,$status,$detail_header,$detail_body,$detail_footer,$image,$created_at,$updated_at){
            $query = "INSERT INTO blogs VALUES ('','$cat_id','$tags_id','$title','$status','$detail_header','$detail_body','$detail_footer','$image','$created_at','$updated_at')";
            $result = false;
            if($this->con->query($query)){
                $result = true;
            }
            $id_blog = $this->con->lastInsertId();
            return json_encode($id_blog);

        }

        public function getId($id){
            $query = "SELECT * FROM blogs WHERE id = '$id'";
            $result = $this->con->query($query);
            $row = array();
            if($result->rowCount()){
                $row = $result->fetch();

                //select cat_ids
                $row['cat_ids'] = array();
                $query_select_cat_id = "SELECT * FROM  blog_categoryofblog where blog_id = '$id'";
                $result_select_cat_id = $this->con->query($query_select_cat_id);
                if($result_select_cat_id->rowCount() > 0){
                    while($row_select_cat_id = $result_select_cat_id->fetch()){
                        array_push($row['cat_ids'],$row_select_cat_id['cat_id']);
                    }
                }

                //select tags_id
                $row['tags_ids'] = array();
                $query_select_tags_id = "SELECT * FROM  blog_tags where blog_id = '$id'";
                $result_select_tags_id = $this->con->query($query_select_tags_id);
                if($result_select_tags_id->rowCount()){
                    while($row_select_tags_id = $result_select_tags_id->fetch()){
                        array_push($row['tags_ids'],$row_select_tags_id['tags_id']);
                    }
                }

            }
            return json_encode($row);
        }



        public function delete($id){
            $query = "DELETE FROM blogs WHERE id = '$id'";
            $result = false;
            if($this->con->query($query)){
                $result = true;
            }
            return json_encode($result);
        }

        public function update_status($id,$status,$updated_at){
            $query = "UPDATE blogs SET status = '$status',updated_at = '$updated_at' WHERE id = '$id'";
            $this->con->query($query);
        }

        public function update($cat_id,$tags_id,$title,$status,$detail_header,$detail_body,$detail_footer,$image,$updated_at,$id){
            $query = "UPDATE blogs SET cat_id='$cat_id',tags_id='$tags_id',title='$title',status='$status',
                 detail_header='$detail_header',detail_body='$detail_body',detail_footer='$detail_footer',image='$image',
                 updated_at='updated_at' WHERE id = '$id'";
            $result = $this->con->query($query);
            return json_encode($result);
        }

        public function get_by_cat_id($id){
            $query = 'SELECT * FROM blogs where cat_id = "$id" order by updated_at DESC';
            $result = $this->con->query($query);
            $arr = array();
            if($result->rowCount() > 0){
                while($row_blog_item = $result->fetch()){
                    $blog_id = $row_blog_item['id'];
                    //add cat_name
                    $row_blog_item['cat_name'] = array();
                    $query_select_blog_categoryofblog = "SELECT * FROM blog_categoryofblog where blog_id = '$blog_id'";
                    $result_select_blog_categoryofblog = $this->con->query($query_select_blog_categoryofblog);
                    if($result_select_blog_categoryofblog->rowCount() > 0){
                        while($row_blog_categoryoblog = $result_select_blog_categoryofblog->fetch()){
                            $cat_id = $row_blog_categoryoblog['cat_id'];
//                            echo "cat_id = ".$cat_id;
                            $query_select_to_get_name_category = "SELECT * FROM category_of_blog WHERE id = '$cat_id'";
                            $result_select_to_get_name_category = $this->con->query($query_select_to_get_name_category);
                            if($result_select_to_get_name_category->rowCount() > 0){
                                $row_select_to_get_name_category = $result_select_to_get_name_category->fetch();
                                array_push($row_blog_item['cat_name'],$row_select_to_get_name_category['name']);
                            }
                        }
                    }
                    //add tags_name
                    $row_blog_item['tags_name'] =  array();
                    $query_select_tags = "SELECT * FROM blog_tags WHERE blog_id = '$blog_id'";
                    $result_select_tags = $this->con->query($query_select_tags);
                    if($result_select_tags->rowCount() > 0){
                        while($row_blog_tags = $result_select_tags->fetch()){
                            $tags_id = $row_blog_tags['tags_id'];

                            $query_select_to_get_name_tags = "SELECT * FROM tags where id = '$tags_id'";
                            $result_select_to_get_name_tags = $this->con->query($query_select_to_get_name_tags);
                            if($result_select_to_get_name_tags->rowCount() > 0){
                                $row_select_to_get_name_tags = $result_select_to_get_name_tags->fetch();
                                array_push($row_blog_item['tags_name'],$row_select_to_get_name_tags['name']);
                            }
                        }
                    }
                    array_push($arr,$row_blog_item);
                }
            }
            return json_encode($arr);
        }

        public function count_blog(){
            $query = "SELECT * from blogs";
            $result = $this->con->query($query);
            return json_encode($result->rowCount());
        }

        public function getListLimit($start_in,$number_display){
            $query = "SELECT * FROM blogs order by updated_at DESC limit $start_in,$number_display";
           
            $result = $this->con->query($query);
            $arr = array();
            if($result->rowCount() > 0){
                while($row_blog_item = $result->fetch()){
                    $blog_id = $row_blog_item['id'];
                    //add cat_name
                    $row_blog_item['cat_name'] = array();
                    $query_select_blog_categoryofblog = "SELECT * FROM blog_categoryofblog where blog_id = '$blog_id'";
                    $result_select_blog_categoryofblog = $this->con->query($query_select_blog_categoryofblog);
                    if($result_select_blog_categoryofblog->rowCount() > 0 ){
                        while($row_blog_categoryoblog = $result_select_blog_categoryofblog->fetch()){
                            $cat_id = $row_blog_categoryoblog['cat_id'];
//                            echo "cat_id = ".$cat_id;
                            $query_select_to_get_name_category = "SELECT * FROM category_of_blog WHERE id = '$cat_id'";
                            $result_select_to_get_name_category = $this->con->query($query_select_to_get_name_category);
                            if($result_select_to_get_name_category->rowCount() > 0){
                                $row_select_to_get_name_category = $result_select_to_get_name_category->fetch();
                                array_push($row_blog_item['cat_name'],$row_select_to_get_name_category['name']);
                            }
                        }
                    }
                    //add tags_name
                    $row_blog_item['tags_name'] =  array();
                    $query_select_tags = "SELECT * FROM blog_tags WHERE blog_id = '$blog_id'";
                    $result_select_tags = $this->con->query($query_select_tags);
                    if($result_select_tags->rowCount()){
                        while($row_blog_tags = $result_select_tags->fetch()){
                            $tags_id = $row_blog_tags['tags_id'];

                            $query_select_to_get_name_tags = "SELECT * FROM tags where id = '$tags_id'";
                            $result_select_to_get_name_tags = $this->con->query($query_select_to_get_name_tags);
                            if($result_select_to_get_name_tags->rowCount() > 0){
                                $row_select_to_get_name_tags = $result_select_to_get_name_tags->fetch();
                                array_push($row_blog_item['tags_name'],$row_select_to_get_name_tags['name']);
                            }
                        }
                    }
                    array_push($arr,$row_blog_item);
                }
            }
            return  json_encode($arr);
        }
    }
?>