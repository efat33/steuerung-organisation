<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceOffer extends Model
{
    use HasFactory;

    /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'get_over',
    'cs_order_number',
    'received_date',
    'received_from',
    'customer_number',
    'contact_person',
    'customer_email_address',
    'contact_number',
    'technical_place',
    'technical_place_address',
    'technical_postcode',
    'registered_by',
    'status',
    'offer_type',
    'ktb_number',
    'quote_number',
    'offer_date',
    'offer_amount',
    'offer_follow_up',
    'conversation_status',
    'maintenance_contact',
    'contact_conclusion',
    'package',
    'sum_per_year',
    'notes',
  ];

  // Join to users table
  public function user()
  {
    return $this->belongsTo(User::class, 'registered_by');
  }
}
