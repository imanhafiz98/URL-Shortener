<?php
  
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Models\ShortLink;
use Str;

class ShortLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shortLinks = ShortLink::latest()->get();
   
        return view('shortenLink', compact('shortLinks'));
    }
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

           if($request->has('checkauto'))
           {
                $request->validate([
                    'link' => 'required|url']);

                 $input['link'] = $request->link;
                 $input['code'] = Str::random(6);
           }

           else
           {
                 $request->validate([
                     'link' => 'required|url',
                     'code' => 'required|unique:short_links']);

                $input['link'] = $request->link;
                $input['code'] = $request->code;
           }

        ShortLink::create($input);
  
        return redirect('generate-shorten-link')
             ->with('success', 'Shorten Link Generated Successfully!');
             
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function shortenLink(ShortLink $shortlink)
    {
        $shortlink->visits= $shortlink->visits + 1;
        $shortlink->save();

        return redirect($shortlink->link);
    }

    
    public function destroy(ShortLink $shortlink)
    {
        $shortlink->delete();

        return redirect('generate-shorten-link')
            ->with('success','Link deleted successfully');

    }
    
}