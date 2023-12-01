<?php

namespace Model;

defined('ROOTPATH') or exit('Access Denied!');

/**
 * User class
 */
class Claim
{

    use Model;
    protected $table = 'claims';
    protected $primaryKey = 'id';
    protected $allowedColumns = [
        'neighborhood',
        'invent_num',
        'address',
        'direction',
        'date_of_excavation',
        'open_square',
        'date_recovery_ABP',
        'square_restored_area',
        'street_type',
        'type_of_work',
        'is_deleted',
        'deleted_at',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'image6',
        'claim_photo',
        'date_of_sign',
        'date_of_sending',
        'date_of_fixing',
        "user_id",
        'res'
    ];
    public $info;

    /*****************************
     * 	rules include:
		required
		alpha
		email
		numeric
		unique
		symbol
		longer_than_8_chars
		alpha_numeric_symbol
		alpha_numeric
		alpha_symbol
     * 
     ****************************/

    protected $validationRules = [

        'neighborhood' => [
            'required',
        ],
        'invent_num' => [
            'required',
            'numeric_fixed_8'
        ],
        'address' => [
            'required',
        ],
        'direction' => [
            'required',
        ],
        'res' => [
            'required',
        ],
        'user_id' => [
            'required',
        ],
        'date_of_excavation' => [
            'required',
        ],
        'open_square' => [
            'alpha_numeric',
            'required',
        ],
        'date_recovery_ABP' => [
            'date',
            'required',
        ],
        'square_restored_area' => [
            'alpha_numeric',
            'required',
        ],
        'street_type' => [
            'required',
        ],
        'type_of_work' => [
            'required',
        ],
        'is_deleted' => [],
        'image1' => [],
        'image2' => [],
        'image3' => [],
        'image5' => [],
        'image6' => [],
        'claim_photo' => [],
        'date_of_sign' => [],
        'date_of_sending' => [],
        'date_of_fixing' => [],
        'user_id' => [],

    ];
    public function validate_before_create($data)
    {
        $this->validate($data);
    }
    public function create($data)
    {

        if ($this->validate($data)) {

            $this->insert($data);
            // redirect('claim/get_my_claims');
        }
    }
    public function update_claim($id, $data)
    {
        if ($this->validate($data)) {

            $this->update($id, $data);
            // redirect('claim/get_my_claims');
        }
    }
    public function get_my_claims($data)
    {
        $claims = $this->where($data);
        if (is_bool($claims)) {
            return 'Данные не найдены!';
        }
        return $claims;
    }
    public function get_single_claim($data)
    {
        $claim = $this->first($data);

        if (is_bool($claim)) {
            return 'Данные не найдены!';
        }
        return $claim;
    }
    public function search($search)
    {
        $claim = $this->match($search);

        if (is_bool($claim)) {
            return 'Данные не найдены!';
        }
        return $claim;
    }
}
