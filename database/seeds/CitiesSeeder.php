<?php

use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = ["Gulshan-e-Iqbal","Habib Baihk","Karachi","Ziauddin","Okara","Islamabad","Rawalpindi","Khanpur","Jhelum","Swabi","Lahore","Faisalabad","Cantt","Gujar Khan","Attock","Goth Abad Magsi","Kasur","Nangar","Sheikhupura","Sialkot","Mandi Bahauddin","Gujrat","Wazirabad","Narowal","Sargodha","Mianwali","Daud Khel","Bahawalpur","Burewala","Abbottabad","Batgram","Havelian","Haripur","Mansehra","Plot","Hyderabad","Miran Shah","Peshawar","Gujranwala","Multan","Quetta","Khan","Kabirwala","Fazal","Clifton","Sarwar","New Mirpur","Saddar","Gulberg","Gilgit","Muzaffarabad","Sarai Sidhu","Dera Ghazi Khan","Sahiwal","Chakwal","Bhimbar","Sukkur","Mandi","Usman","Charsadda","Nowshera","Mardan","Mian Channu","Khanewal","Jhang Sadr","Jhang City","Toba Tek Singh","Jhumra","Daska","Kohat","Nankana Sahib","Pindi","Rawlakot"];

        App\City::truncate();

        foreach($cities as $loc){
            $city = new \App\City();
            $city->name = $loc;
            $city->save();
        }
    }
}
