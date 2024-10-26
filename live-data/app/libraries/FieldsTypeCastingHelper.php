<?php

namespace App\libraries;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use HTML;
use Config;

/**
 * FieldsTypeCastingHelper Helper
 *
 * Add your methods in the class below
 */
class FieldsTypeCastingHelper {
	
	
	/**
     * FieldsTypeCastingHelper::typeCastVolumaticWeight()
     * @Description Function to typecast volumatricWeight
     * @param $input as value
     * @return $input
     * */	 
    public static function typeCastVolumatricWeight($input) {
		return (float)$input;
	}
	
	
	/**
     * FieldsTypeCastingHelper::typeCastWeight()
     * @Description Function to typecast weight
     * @param $input as value
     * @return $input
     * */	
    public static function typeCastWeight($input) {
		return (float)$input;
	}
	
	/**
     * FieldsTypeCastingHelper::typeCastLength()
     * @Description Function to typecast weight
     * @param $input as value
     * @return $input
     * */	
    public static function typeCastLength($input) {
		return (float)$input;
	}
	
	/**
     * FieldsTypeCastingHelper::typeCastBreadth()
     * @Description Function to typecast weight
     * @param $input as value
     * @return $input
     * */	
    public static function typeCastBreadth($input) {
		return (float)$input;
	}
	
	/**
     * FieldsTypeCastingHelper::typeCastHeight()
     * @Description Function to typecast weight
     * @param $input as value
     * @return $input
     * */	
    public static function typeCastHeight($input) {
		return (float)$input;
	}
	
	
	/**
     * FieldsTypeCastingHelper::packingCharges()
     * @Description Function to typecast weight
     * @param $input as value
     * @return $input
     * */	
    public static function typeCastPackingChargesField($input) {
		return (float)$input;
	}
	
	
	/**
     * FieldsTypeCastingHelper::typeCastActiveField()
     * @Description Function to typecast weight
     * @param $input as value
     * @return $input
     * */	 
    public static function typeCastActiveField($input) {
		return (int)$input;
	}
	
	
	/**
     * FieldsTypeCastingHelper::typeCastPaginateField()
     * @Description Function to typecast weight
     * @param $input as value
     * @return $input
     * */	 
    public static function typeCastPaginate($input) {
		return (int)$input;
	}
	
	
	/**
     * FieldsTypeCastingHelper::typeCastTypeField()
     * @Description Function to typecast weight
     * @param $input as value
     * @return $input
     * */
    public static function typeCastTypeField($input) {
		return (int)$input;
	}
	
	
	/**
     * FieldsTypeCastingHelper::typeCastActiveField()
     * @Description Function to Block weight
     * @param $input as value
     * @return $input
     * */	
    public static function typeCastBlockField($input) {
		return (int)$input;
	}
	
	
	/**
     * FieldsTypeCastingHelper::typeCastDeleteField()
     * @Description Function to Delete weight
     * @param $input as value
     * @return $input
     * */	 
    public static function typeCastDeleteField($input) {
		return (int)$input;
	}
	
	
	/**
     * FieldsTypeCastingHelper::typeCastVerifiedField()
     * @Description Function to Verified weight
     * @param $input as value
     * @return $input
     * */	
    public static function typeCastVerifiedField($input) {
		return (int)$input;
	}
	
	
	/**
     * FieldsTypeCastingHelper::typeCastLoadRateCardField()
     * @Description Function to load rate card width
     * @param $input as value
     * @return $input
     * */	
    public static function typeCastLoadRateCardField($input) {
		return (int)$input;
	}
	
	
	/**
     * FieldsTypeCastingHelper::typeCastLoadRateCardField()
     * @Description Function to load rate card width
     * @param $input as value
     * @return $input
     * */	 
    public static function typeCastPrices($input) {
		return (float)$input;
	}
	/**
     * FieldsTypeCastingHelper::typeCastStatusFields()
     * @Description Function to load rate card width
     * @param $input as value
     * @return $input
     * */	 
    public static function typeCastStatusFields($input) {
		return (int)$input;
	}
	
	
	/**
     * FieldsTypeCastingHelper::typeCastStatusFields()
     * @Description Function to load rate card width
     * @param $input as value
     * @return $input
     * */	 
    public static function typeCastPercentFields($input) {
		return (float)$input;
	}
	
	 /**
     * FieldsTypeCastingHelper::typeDefaultApproveFields()
     * @Description Function to load rate card width
     * @param $input as value
     * @return $input
     * */    
    public static function typeDefaultApproveFields($input) {
        return (int)$input;
    }
	
	
	/**
     * FieldsTypeCastingHelper::typePriceApproveFields()
     * @Description Function to load rate card width
     * @param $input as value
     * @return $input
     * */ 
	public static function typePriceApproveFields($input) {
        return (float)$input;
    }
	
	
}
