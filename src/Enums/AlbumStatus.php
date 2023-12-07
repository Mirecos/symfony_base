<?php

namespace App\Enum;

enum AlbumStatus : string
{
    case Available = "Available";
    case Incoming = "Incoming";
    case NotAvailable = "Not Available";
    
}