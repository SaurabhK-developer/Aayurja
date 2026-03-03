<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model



{
    protected $fillable = ['product_name','tranding','product_category','product_subcategory','product_tags','design','additional_info','description','occasion','slug','outofstock','on_sale','first_content','list_image','gender','metal_color','style','most_popular','best_sellers','group_code','color_code','product_code','flavors','key_benefits','offer','concern','product_video','short_description'];
    
    
     public function firstimage()
    {
        return $this->belongsTo(Product_Image::class, 'id', 'product_id')->orderBy('id', 'asc');
    }
    
    protected $casts = [
        'concern' => 'array',
    ];
  
    public function category()
    {
        return $this->belongsTo(Product_category::class, 'product_category');
    }

    public function subcategory()
    {
        return $this->belongsTo(Product_sub_category::class, 'product_subcategory');
    }

    public function style()
    {
        return $this->belongsTo(Style::class, 'style');
    }
    public function Type()
    {
        return $this->belongsTo(Type::class, 'type');
    }
   
    public function design()
    {
        return $this->belongsTo(Designer::class, 'design');
    }


    public function metalcolor()
    {
        return $this->belongsTo(Metalcolor::class, 'metal_color');
    }
    
    public function metal()
    {
        return $this->belongsTo(Material::class, 'meterial');
    }
    

    public function Size_data()
    {
        return $this->belongsTo(Size::class, 'size');
    }


    public function purity()
    {
        return $this->belongsTo(Metalpurity::class, 'metal_purity');
    }

    public function all_flavours()
    {
        return $this->hasMany(flavourmappings::class, 'productid','id');
    }
    
    public function tag(){
        return $this->belongsTo(Tag::class, 'tags');
      }
      
    public function Occasion()
    {
        return $this->belongsTo(Occasion::class, 'occasion');
    }
    public function buy_product()
    {
        return $this->belongsTo(BuyProduct::class, 'product_id');
    }

    public function product_variants()
    {
        return $this->hasMany(ProductVariants::class, 'product_id');
        
    }

    public function variants_price()
    {
        return $this->belongsTo(ProductVariants::class,  'id','product_id')->orderBy('price', 'asc');
        
    }

    public function variants_price_desc()
    {
        return $this->belongsTo(ProductVariants::class,  'id','product_id')->orderBy('price', 'desc');
        
    }
    public function variants_size()
    {
        return $this->belongsTo(ProductVariants::class,  'id','product_id')->orderBy('price', 'asc');
        
    }
 

    public function images()
    {
        return $this->belongsTo(Product_image::class, 'id', 'product_id');
    }
    
  

    // public function review()
    // {
    //     return $this->belongsTo(Rating::class, 'id', 'product_id');
    // }

     public function review()
    {
        // return $this->hasMany(Rating::class, 'product_id'); // Adjust the class and foreign key if necessary
        return $this->hasMany(Rating::class, 'product_id')->where('status', 1);
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_code', 'hash_value');
    }

        public function concerns()
    {
        return $this->belongsToMany(Concern::class, 'products', 'concern');
    }




    
}
