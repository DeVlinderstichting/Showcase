<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;
use Hash;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
	public function adminWelcome()
	{
		return view('adminLogin');
	}
    public function adminHome()
    {
        if (!($this->checkIsAdmin()))
        {
            return view('adminLogin');
        }
        return view('adminHome');
    }

    public function adminLogin()
    {
    	$valDat = request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(auth()->attempt(array('email' => $valDat['username'], 'password' => $valDat['password']))) 
        {
        	if ($this->checkIsAdmin())
        	{
        		return view('adminHome');
        	}
        }
        return view('adminLogin');
    }
    public function regionCreate()
    {
    	if (!$this->checkIsAdmin())
    	{
    		return view('adminLogin');
    	}
        $region = new Region();
        $region->id = -1;
        return view('regionCreate', ['region' => $region]);
    }
    public function regionStore($regionId = null)
    {
    	if (!($this->checkIsAdmin()))
    	{
    		return view('adminLogin');
    	}

    	$valDat = request()->validate([
            'name' => ['required','unique:regions' . ($regionId > 0 ? ',name,' . $regionId : '')],
            'description' => ['required'], 
            'regionData' => ['nullable'] 
        ]);

    	if (($regionId == null) || ($regionId == -1))
    	{
    		$region = new \App\Models\Region();
    	}
    	else 
    	{
    		$region = \App\Models\Region::find($regionId);
    	}
        $geom = json_decode($valDat['regionData']);
        if (strlen($geom) > 5)
        {
            $region->location = $geom;
        }
        $region->name = $valDat['name'];
        $region->description = $valDat['description'];
        $region->save();

        $allSp = \App\Models\Species::all();
        $foundIds = [];
        foreach($allSp as $sp)
        {
            $fieldName= 'spCanCount_' . $sp->id;
            if (request()->has($fieldName))
            {
                $foundIds[] = $sp->id;
                $rsp = \App\Models\RegionsSpecies::where('species_id', $sp->id)->where('region_id', $region->id)->first();
                if ($rsp == null)
                {
                    $rsp = \App\Models\RegionsSpecies::create(['species_id' => $sp->id, 'region_id' => $region->id]);
                }
            }
        }
        foreach(\App\Models\ManagementType::all() as $mt)
        {
            if (request()->exists('mt_' . $mt->id))
            {
                $region->managementtypes()->attach($mt);
            }
            else 
            {
                $region->managementtypes()->detach($mt);
            }
        }
        foreach(\App\Models\LanduseType::all() as $lt)
        {
            if (request()->exists('lt_' . $lt->id))
            {
                $region->landusetypes()->attach($lt);
            }
            else 
            {
                $region->landusetypes()->detach($lt);
            }
        }

        $removeMe = \App\Models\RegionsSpecies::whereNotIn('species_id', $foundIds)->where('region_id', $region->id)->get();
        foreach($removeMe as $tbr)
        {
            $tbr->delete();
        }
        return view ('adminHome');
    }
    public function regionIndex()
    {
        if (!($this->checkIsAdmin()))
        {
            return view('adminLogin');
        }
        return view ('regionIndex', ['regions' => \App\Models\Region::all()]);
    }
    public function regionEdit(Region $region)
    {
        if (!($this->checkIsAdmin()))
        {
            return view('adminLogin');
        }
        return view('regionCreate', ['region'=>$region]);
    }

    public function userIndex()
    {
        if (!($this->checkIsAdmin()))
        {
            return view('adminLogin');
        }
        return view('userIndex');
    }
    public function userIndexAjax()
    {
        if (!($this->checkIsAdmin()))
        {
            return "An error occured please login again.";
        }

        $rules = [
            'name' => ['nullable', 'alpha_num_spaces', 'max:100'], 
            'email' => ['nullable', 'partial_email', 'max:100']
        ];
        $valDat = request()->validate($rules);
        $user = Auth::user();
        
        $takeNum = 10;
        if (array_key_exists('name', $valDat))
        {
            if (substr($valDat['name'],-1)=="*")
            {
                $valDat['name'] = substr($valDat['name'], 0, -1);
                $takeNum = 100;
            }
            if (substr($valDat['name'],-1)=="*")
            {
                $valDat['name'] = substr($valDat['name'], 0, -1);
                $takeNum = 200;
            }
        }
        $searchResult = \App\Models\User::query()->take($takeNum)->select(['id', 'name', 'email']);
        foreach($valDat as $key => $value)
        {
            if(($value!="") && ($value!=null))
            {
                $searchResult = $searchResult->where($key, 'iLIKE', '%' . $value . '%');
            }
        }
        return $searchResult->get()->toArray();
    }

    public function createUser($userId = -1)
    {
        if (!($this->checkIsAdmin()))
        {
            return view('adminLogin');
        }
        if ($userId == -1)
        {
            $user = new \App\Models\User();
            $user->id = -1;
        }
        else 
        {
            $user = \App\Models\User::find($userId);
        }
        return view('userCreate', ['user' => $user]);
    }
    public function storeUser($userId)
    {
        if (!($this->checkIsAdmin()))
        {
            return view('adminLogin');
        }

        $rules = [
            'email' => ['required', 'partial_email','unique:users' . ($userId > 0 ? ',email,' . $userId : ''), 'max:100'],
            'name' => ['required', 'alpha_num_underscore_minus_dot_at', 'unique:users' . ($userId > 0 ? ',name,' . $userId : ''), 'max:100'],
            'prefered_language' => ['required', Rule::in(['nl','en','fr','es','pt','it','de','dk','no','se','fi','ee','lv','lt','pl','cz','sk','hu','au','ch','si','hr','ba','rs','me','al','gr','bg','ro'])],
        ];
        if ($userId == -1)
        {
            $rules['password'] = ['required', 'max:100', 'min:5'];
        }
        $valDat = request()->validate($rules);

        if ($userId == -1)
        {
            $user = \App\Models\User::create(['email' => $valDat['email'], 'password' => $valDat['password'], 'name' => $valDat['name'], 'prefered_language' => $valDat['prefered_language'], 'accesstoken' => '']);
            $user->setRandomAccessToken();
            $user->save();
        }
        else 
        {
            $user = \App\Models\User::find($userId);
            $user->email = $valDat['email'];
            $user->name = $valDat['name'];
            $user->prefered_language = $valDat['prefered_language'];

            if (array_key_exists('password', $valDat))
            {
                if (strlen($valDat['password'] == "*****"))
                {
                    $user->password = Hash::make($valDat['password']);
                }
            }
            $user->save();
        }
        
        $otherFields = ['sci_names', 'show_previous_observed_species', 'show_only_common_species'];
        foreach ($otherFields as $otherField)
        {
            if (request()->has($otherField))
            {
                $user->$otherField = true;
            }
            else 
            {
                $user->$otherField = false;
            }
        }

        $allRegions = \App\Models\Region::all();
        $theRegionIds = [];
        foreach($allRegions as $region)
        {
            if (request()->has("region_".$region->id))
            {
                $theRegionIds[] = $region->id;
                $ur = \App\Models\RegionsUsers::where('user_id', $user->id)->where('region_id', $region->id)->first();
                if ($ur == null)
                {
                    \App\Models\RegionsUsers::create(['user_id' => $user->id, 'region_id' => $region->id]);
                }
            }
        }
        $removeMeRegions = \App\Models\RegionsUsers::whereNotIn('region_id', $theRegionIds)->where('user_id', $user->id)->get();
        foreach($removeMeRegions as $tbr)
        {
            $tbr->delete();
        }

        $user->save();

        return view ('adminHome');
    }
    public function createPushmessage($messageId = -1)
    {
        if (!($this->checkIsAdmin()))
        {
            return view('adminLogin');
        }
        if ($messageId == -1)
        {
            $message = new \App\Models\PushMessage();
            $message->id = -1;
            $firstRegion = \App\Models\Region::first();
            if ($firstRegion == null)
            {
                $message->region_id = -1;
            }
            else 
            {
                $message->region_id = $firstRegion->id;
            }
        }
        else 
        {
            $message = \App\Models\PushMessage::find($messageId);
        }
        return view('messageCreate', ['message' => $message]);
    }
    public function storePushmessage($messageId = -1)
    {
        if (!($this->checkIsAdmin()))
        {
            return view('adminLogin');
        }
        $valDat = request()->validate([
            'header' => ['required'],
            'content' => ['required'], 
            'region_id' => ['required', 'exists:regions,id'],
        ]);

        $img1Placeholder = "bf1.jpg";
        $img2Placeholder = "bf2.jpg";

        if ($messageId == -1)
        {
            $pm = \App\Models\PushMessage::create(['header' => $valDat['header'], 'content' => $valDat['content'], 'region_id' => $valDat['region_id'], 'image_primary' => $img1Placeholder, 'image_secondary' => $img2Placeholder]);

            $region = \App\Models\Region::find($valDat['region_id']);
            $regionUsers = $region->users()->get();
            foreach($regionUsers as $reUs)
            {
                \App\Models\UsersPushMessage::create(['user_id' => $reUs->id, 'pushmessage_id' => $pm->id, 'senddate' => Carbon::now()]);
            }
        }
        else 
        {
            $pm = \App\Models\PushMessage::find($messageId);
            $pm->header = $valDat['header'];
            $pm->content = $valDat['content'];
            $pm->region_id = $valDat['region_id'];
            $pm->image_primary = $img1Placeholder;
            $pm->image_secondary = $img2Placeholder;
            $pm->save();            
        }
        return view ('pushMessageIndex', ['messages' => \App\Models\PushMessage::all()]);
    }
    public function pushMessageIndex()
    {
        if (!($this->checkIsAdmin()))
        {
            return view('adminLogin');
        }
        return view ('pushMessageIndex', ['messages' => \App\Models\PushMessage::all()]);
    }

    public function newsItemIndex()
    {
        if (!($this->checkIsAdmin()))
        {
            return view('adminLogin');
        }
        return view ('newsItemIndex', ['newsitems' => \App\Models\NewsItem::all()]);
    }
    public function createNewsItem($newsItem = -1)
    {
        if (!($this->checkIsAdmin()))
        {
            return view('adminLogin');
        }
        if ($newsItem == -1)
        {
            $newsItem = new \App\Models\NewsItem();
            $newsItem->id = -1;
        }
        else
        {
            $newsItem = \App\Models\NewsItem::find($newsItem);
        }

        return view ('newsItemCreate', ['newsItem' => $newsItem]);
    }
    public function storeNewsItem($messageId)
    {
        if (!($this->checkIsAdmin()))
        {
            return view('adminLogin');
        }
        $valDat = request()->validate([
            'title' => ['required'],
            'introduction' => ['required'], 
            'moreinfo' => ['nullable'], 
            'maintext' => ['required'], 
            'image1' => ['nullable'], 
            'image2' => ['nullable']
        ]);

        if ($messageId == -1)
        {
            \App\Models\NewsItem::create($valDat);
        }
        else 
        {
            $ni = \App\Models\NewsItem::find($messageId);
            if ($ni != null)
            {
                $ni->title = $valDat['title'];
                $ni->introduction = $valDat['introduction'];
                $ni->maintext = $valDat['maintext'];
                if (array_key_exists('moreinfo', $valDat))
                {
                    $ni->moreinfo = $valDat['moreinfo'];
                }
                if (array_key_exists('image1', $valDat))
                {
                    $ni->image1 = $valDat['image1'];
                }
                if (array_key_exists('image2', $valDat))
                {
                    $ni->image2 = $valDat['image2'];
                }
                $ni->save();
            }
        }

        return redirect()->route('newsindex');
    }

    public function translationIndex()
    {
        if (!($this->checkIsAdmin()))
        {
            return view('adminLogin');
        }
        return view('translationIndex');
    }
    public function translationEdit($language = "")
    {
        if (!($this->checkIsAdmin()))
        {
            return view('adminLogin');
        }
        $lanArr = ['nl','en','fr','es','pt','it','de','dk','no','se','fi','ee','lv','lt','pl','cz','sk','hu','au','ch','si','hr','ba','rs','me','al','gr','bg','ro'];
        if (!(in_array($language, $lanArr)))
        {
            return "invalid language selected";
        }

        return view('translationEdit', ['language' => $language]);
    }
    public function translationPutAjax()
    {
        if (!($this->checkIsAdmin()))
        {
            return view('adminLogin');
        }
        $valDat = request()->validate([
            'key' => ['required', 'exists:languages,id'],
            'language' => ['required', Rule::in(['nl','en','fr','es','pt','it','de','dk','no','se','fi','ee','lv','lt','pl','cz','sk','hu','au','ch','si','hr','ba','rs','me','al','gr','bg','ro'])],
            'value' => ['required']
        ]);
        $theFieldname = $valDat['language'];
        $theKey = \App\Models\Language::where('id', $valDat['key'])->first();
        $theKey->$theFieldname = $valDat['value'];
        $theKey->save();
    }
    public function handleRApiRequest()
    {
        $valDat = request()->validate(
        [
            'accesstoken' => ['required', 'min:50', 'exists:users,accesstoken'],
            'username' => ['required', 'min:2', 'exists:users,name'],
            'table_name' => ['required', Rule::in(['observations', 'visits'])],
        ]);
        $user = \App\User::where('accesstoken', $valDat['accesstoken'])->where('name', $valDat['username'])->first();
        if (($user == null) || (!$user->isadmin))
        {
            die("invalid user");
        }
        Auth::login($user);
        $sqLine = "";
        if ($valDat['table_name'] == 'observations')
        {
            $sqLine = "SELECT * FROM observations";
        }
        if ($valDat['table_name'] == 'visits')
        {
            $sqLine = "SELECT * FROM visits";
        }

        $res = DB::select(DB::raw($sqLine));
        return json_encode($res);
    }

    private function checkIsAdmin()
    {
    	$user = Auth::user();
    	if ($user != null)
		{
			if ($user->isadmin)
			{
				return true;
			}
		}
    	return false;
    }
}
