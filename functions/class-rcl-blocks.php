<?php
class Rcl_Blocks {
    
    public $place;
    public $callback;
    public $args = array(
                'id'=>'',
                'class'=>'',
                'title'=>'',
                'gallery'=>0,
                'public'=>1,
                'order'=>10,
                'width'=>50
            );
    
    
    function __construct($data){
        $this->init_properties($data);
    }
    
    function init_properties($args){

        $properties = get_class_vars(get_class($this));

        foreach ($properties as $name=>$val){
            
            if(!isset($args[$name])) continue;
            
            if($name=='args'){
                $this->args = wp_parse_args( $args[$name], $this->args  );
                continue;
            }
            
            $this->$name = $args[$name];
     
        }
        
    }
    
    function add_block(){
        add_action('rcl_area_'.$this->place,array($this,'print_block'),$this->args['order']);
    }
    
    function print_block(){
        global $user_LK;
        echo $this->get_block($user_LK);
    }

    function get_block($user_lk){
        global $user_ID;
        
        switch($this->args['public']){
            case 0: if(!$user_ID||$user_ID!=$user_lk) return false; break; //только хозяину ЛК
            case -1: if(!$user_ID||$user_ID==$user_lk) return false; break; //всем зарегистрированным кроме хозяина ЛК
            case -2: if($user_ID&&$user_ID==$user_lk) return false; break; //всем посетителям кроме хозяина
        }
        
        $cl_content = $this->get_callback_content($user_lk);
        if(!$cl_content) return false;

        
        $content .= '<div';
        if($this->args['id']) $content .= ' id="'.$this->id.'"';
        $content .= ' class="'.$this->place.'-block-rcl block-rcl';
        if($this->args['class']) $content .= ' '.$this->class;
        $content .= '">';
        if($this->args['title']) $content .= '<h4>'.$this->args['title'].'</h4>';
        $content .= $cl_content;

        if($this->args['gallery']){

            $content .= '<script>jQuery("#'.$this->args['gallery'].'").bxSlider({
            pager:false,
            minSlides: 1,
            maxSlides: 20,
            slideWidth: '.$this->args['width'].',
            infiniteLoop:true,
            slideMargin: 5,
            moveSlides:1
            });</script>';
        }

        $content .= '</div>';

        return $content;
    }
    
    function get_callback_content($author_lk){
        
        $callback = $this->callback;
        
        if(is_array($callback)){
            $object = new $callback[0];
            $method = $callback[1];
            $content = $object->$method($author_lk);
        }else{
            $content = $callback($author_lk);
        }

        return $content;

    }
}
