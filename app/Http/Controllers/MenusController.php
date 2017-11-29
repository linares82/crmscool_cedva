<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Menu;
use Illuminate\Http\Request;
use Auth;
use Log;

class MenusController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public $menuArmado = "";

    public function index(Request $request) {
        $menus = Menu::getAllData($request);

        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('menus.create')
                        ->with('list', Menu::getListFromAllRelationApps());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {

        //create data
        Menu::create($request->all());

        return redirect()->route('menus.index')->with('message', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Menu $menu) {
        return view('menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Menu $menu) {
        return view('menus.edit', compact('menu'))
                        ->with('list', Menu::getListFromAllRelationApps());
    }

    /**
     * Show the form for duplicatting the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function duplicate(Menu $menu) {
        return view('menus.duplicate', compact('menu'))
                        ->with('list', Menu::getListFromAllRelationApps());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update(Menu $menu, Request $request) {
        //update data
        $menu->update($request->all());

        return redirect()->route('menus.index')->with('message', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Menu $menu) {
        $menu->delete();

        return redirect()->route('menus.index')->with('message', 'Item deleted successfully.');
    }

    public function armaMenuPrimario($padre = 1) {
        //$menu=$this->menuRepository->search(array('padre'=>$padre));
        //$usuario_actual=User::find(Auth::user()->id)->is('admin');
        $menu = Menu::where('padre', $padre)
                        ->where('activo', true)
                        ->orderBy('prioridad', 'asc')->get();

        //dd($menu);

        if (!empty($menu)) {
            //dd($menu);
            foreach ($menu as $item) {
                //$permiso=User::find(Auth::user()->id)->can($item->permiso);

                if ($item->permiso <> "home") {
                    $permiso = Auth::user()->can($item->permiso);
                } else {
                    $permiso = true;
                }
                $link = route($item->link);
                //dd($permiso);
                if ($permiso and $item->activo == 1 and $item->parametros == "_blank") {
                    $this->menuArmado = $this->menuArmado . "<li class='active' style='background:".$item->color."' ><a href='" . $link . "' target='" . $item->parametros . "'><i class='" . $item->imagen . "'></i><span>" . $item->item . "</span></a></li>";
                }
            }
        }

        //dd($this->menuArmado);
        return $this->menuArmado;
    }

    public function armaMenu($padre = 1) {
        if (session()->has('menu')) {
            return session('menu');
        } else {
            $m = $this->armaMenuPrincipal();
            session(['menu' => $m]);

            //dd($this->menuArmado);
            return session('menu');
            //return $this->menuArmado;
        }
    }

    public function armaMenu2($padre = 43) {
        if (session()->has('menu2')) {
            //Log::info(session('menu2'));
            return session('menu2');
        } else {
            $m = $this->armaMenuPrincipal($padre);
            session(['menu2' => $m]);

            //dd($this->menuArmado);
            return session('menu2');
            //return $this->menuArmado;
        }
    }

    public function armaMenuPrincipal($padre = 1) {
        $permiso = false;
        //$menu=$this->menuRepository->search(array('padre'=>$padre));
        //$usuario_actual=User::find(Auth::user()->id)->is('admin');
        $menu = Menu::where('padre', $padre)
                        ->where('activo', true)
                        ->orderBy('prioridad', 'asc')->get();

        //dd($menu);

        if (!empty($menu)) {
            //dd($menu);
            foreach ($menu as $item) {
                //$permiso=User::find(Auth::user()->id)->can($item->permiso);
                $autenticado = Auth::user();
                //Log::info($autenticado);

                if ($item->permiso <> "home" and $item->permiso <> "logout") {
                    if (Auth::check()) {
                        $permiso = Auth::user()->can($item->permiso);
                    }
                } else {
                    //dd($item->permiso);
                    $permiso = true;
                }
                $link = route($item->link);
                //dd($permiso);
                if ($permiso and $item->activo == 1) {
                    //dd($item->id);
                    $r = intval($this->tieneItems($item->id));
                    //dd(action($item->link));

                    if ($r == 1) {
                        if ($item->parametros == "_blank") {
                            $this->menuArmado = $this->menuArmado . "<li class='treeview'  style='background:".$item->color.";'>
									                <a href=' " . $link . " ' target='" . $item->parametros . "'>
														<i class='" . $item->imagen . "'></i><span>" . $item->item . "</span> <i class='fa fa-angle-left pull-right'></i>
													</a>
									                <ul class='treeview-menu'>";
                        } else {
                            $this->menuArmado = $this->menuArmado . "<li class='treeview' style='background:".$item->color.";'>
									                <a href=' " . $link . " '>
														<i class='" . $item->imagen . "'></i><span>" . $item->item . "</span> <i class='fa fa-angle-left pull-right'></i>
													</a>
									                <ul class='treeview-menu'>";
                        }

                        $this->menuArmado = $this->armaMenuPrincipal($item->id);
                        $this->menuArmado = $this->menuArmado . "</ul></li>";
                    } else {
                        //dd($this->menuArmado);
                        if ($item->parametros == "_blank") {
                            $this->menuArmado = $this->menuArmado . "<li class='active' style='background:".$item->color.";'><a href='" . $link . "' target='" . $item->parametros . "'><i class='" . $item->imagen . "'></i><span>" . $item->item . "</span></a></li>";
                        } else {
                            $this->menuArmado = $this->menuArmado . "<li class='active' style='background:".$item->color.";'><a href='" . $link . "'><i class='" . $item->imagen . "'></i><span>" . $item->item . "</span></a></li>";
                        }
                    }
                    //Log::info($this->menuArmado);
                }
            }
            return $this->menuArmado;
        }


        //dd($this->menuArmado);
        //return $this->menuArmado;
    }

    public function tieneItems($padre) {
        $menu = Menu::where('padre', $padre)->where('activo', true)->count();

        //dd($menu);
        if ($menu == 0) {
            return -1;
        } else {
            return 1;
        }
    }

}
