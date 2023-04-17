<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Notifications\NotifyQuantityAlert;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Modules\Product\Entities\Producto;
use Modules\Sale\Entities\Sale;
use App\Models\User;
use App\Traits\Tenantable;

class LineaProducto extends Model implements HasMedia
{

    use HasFactory, InteractsWithMedia, Tenantable;

    protected $table = 'linea_productos';


    protected $fillable = [
        'producto_id', 'usuario_id', 'descripcion', 'cantidad', 'fecha', 'stock', 'comprobante_id', 'tasa_iva_id', 'iva'
    ];

    public $timestamps = false;

    public function producto(){
        return $this->belongsTo(Produc::class, 'producto_id')->withTrashed();
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function comprobante(){
        return $this->belongsTo(Sale::class, 'comprobante_id');
    }


}
