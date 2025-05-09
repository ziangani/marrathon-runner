<?php

namespace App\Common;

use Illuminate\Http\Request;


class GeneralStatus
{   
    const STATUS_ACTIVE  = "ACTIVE";
    const STATUS_INACTIVE  = "INACTIVE";
    const STATUS_ENABLED  = "ENABLED";
    const STATUS_DISABLED  = "DISABLED";
    const STATUS_DELETED  = "DELETED";
    const STATUS_PENDING  = "PENDING";
    const STATUS_BLOCKED  = "BLOCKED";
    const STATUS_USED  = "USED";
    const STATUS_ERROR  = "ERROR";
    const STATUS_SUCCESS  = "SUCCESS";
    const STATUS_PARTIAL  = "PARTIAL";
    const STATUS_COMPLETE  = "COMPLETE";
    const STATUS_PENDING_APPROVAL  = "PENDING_APPROVAL";
    const STATUS_PENDING_INTERVIEW  = "PENDING_INTERVIEW";
    const STATUS_PENDING_CLAIM_SUBMISSION = "PENDING_CLAIM_SUBMISSION";
    const STATUS_PENDING_PAYMENT_INITIATION  = "PENDING_PAYMENT_INITIATION";
    const STATUS_PENDING_PAYMENT_APPROVAL  = "PENDING_PAYMENT_APPROVAL";
    const STATUS_PAYMENT_PAID  = "PAID";
    const STATUS_APPROVED  = "APPROVED";
    const STATUS_DECLINED  = "DECLINED";
    const STATUS_REVIEWED  = "REVIEWED";
    const STATUS_FULL  = "FULL";
    const STATUS_VERIFIED  = "VERIFIED";
    const STATUS_EXPIRED  = "EXPIRED";
    const STATUS_LOCKED  = "LOCKED";
    const STATUS_NA  = "NA";

    private static $mappings    = [
        self::STATUS_PENDING_APPROVAL => 'Pending Upload Approval',
        self::STATUS_PENDING_PAYMENT_INITIATION => 'Pending Payment Initiation',
        self::STATUS_PENDING_PAYMENT_APPROVAL => 'Pending Payment Approval',
        self::STATUS_COMPLETE => 'Complete',
        self::STATUS_PARTIAL => 'Partial',
        self::STATUS_PENDING => 'Pending',
    ];

    public static function mappings(){
        return self::$mappings;
    }

    public static function map($status){
        return self::$mappings[$status];
    }
}
