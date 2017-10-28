<?php


function authUser()
{
	return auth()->user();
}

/**
 * check if the user have permission
 * @param  string $permission 
 * @return mixed             
 */
function checkPermission($permission)
{
	if (authUser()->cannot($permission)) {
		throw new App\Exceptions\ForbiddenException('you do not have permission to access this page.', 403);
	}
}

// function checkAuthorization($permission)
// {
// 	if(! $this->authorize($permission)){
//     abort(403, 'You are not authorize');
//   }
// }

/**
 * sets active class to active nav link
 * @param string $route 
 * @param string $class 
 */
function setActive($route, $class = 'active')
{
	return (Route::getCurrentRoute()->getName() == $route) ? $class : '';
}

/**
 * sets active class to active nav link
 * @param string $route 
 * @param string $class 
 */
function set_active($path, $active = 'active')
{
	return str_contains(Request::path(), $path) ? $active : '';
}

function setFrontActive($path, $active = 'active')
{
		return Request::path() == $path ? $active: '';
}

function getThumbnail($photoPath)
{
	$name = explode('/', $photoPath);
	array_push($name, 'thumbnail-' . array_pop($name));

	return implode('/', $name);
}

function getSmallThumbnail($photoPath)
{
	$name = explode('/', $photoPath);
	array_push($name, 'thumbnail-small-' . array_pop($name));

	return implode('/', $name);
}

// function filterRoute($route){
// 	if(str_contains($request->path(), 'admin')){
		
// 	}
// }

/**
 * checks if the user is authorised or not
 * @param  string $rule  
 * @param  mixed $model 
 * @return mixed        
 */
function youAreDenied($rule, $model)
{
  if(\Gate::denies($rule, $model)){
      abort(403, 'Sorry! You are not authorized for this action.');
  }
}

function getCategories()
{
	return [
		'home_furniture' => 'Home Furniture',
		'office_furniture' => 'Office Furniture',
		'electronics' => 'Electronics',
		'others' => 'Others'
	];
}
