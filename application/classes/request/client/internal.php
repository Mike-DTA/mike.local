<?php defined('SYSPATH') or die('No Access');

class Request_Client_Internal extends Kohana_Request_Client_Internal
{
	public function execute_request(Request $request)
	{
		// Create the class prefix
		$prefix = 'controller_';//conflict

		// Directory
		$directory = $request->directory();

		// Controller
		$controller = $request->controller();

		if ($directory)
		{
			// Add the directory name to the class prefix
			$prefix .= str_replace(array('\\', '/'), '_', trim($directory, '/')).'_';
		}

		if (Kohana::$profiling)
		{
			// Set the benchmark name
			$benchmark = '"'.$request->uri().'"';

			if ($request !== Request::$initial AND Request::$current)
			{
				// Add the parent request uri
				$benchmark .= ' « "'.Request::$current->uri().'"';
			}

			// Start benchmarking
			$benchmark = Profiler::start('Requests', $benchmark);
		}

		// Store the currently active request
		$previous = Request::$current;

		// Change the current request to this request
		Request::$current = $request;

		// Is this the initial request
		$initial_request = ($request === Request::$initial);

		try
		{
			$aRoute = Route::get('default')->defaults();

			if ( ! class_exists($prefix.$controller))
			{
				$action = $controller;
				$controller = $aRoute['controller']; 
			}

			// Load the controller using reflection
			$class = new ReflectionClass($prefix.$controller);

			if ($class->isAbstract())
			{
				throw new Kohana_Exception('Cannot create instances of abstract :controller',
					array(':controller' => $prefix.$controller));
			}

			// Create a new instance of the controller
			$controller = $class->newInstance($request, $request->response() ? $request->response() : $request->create_response());

			$class->getMethod('before')->invoke($controller);

			// Determine the action to use
			if(!isset($action))
			{
				$action = $request->action();
			}

			// If the action doesn't exist, it's a 404
			if ( ! $class->hasMethod('action_'.$action))
			{
				$action = $aRoute['action'];
				// throw new HTTP_Exception_404('The requested URL :uri was not found on this server.',
				// 									array(':uri' => $request->uri()));
			}

			$method = $class->getMethod('action_'.$action);
			$method->invoke($controller);

			// Execute the "after action" method
			$class->getMethod('after')->invoke($controller);
		}
		catch (Exception $e)
		{
			// Restore the previous request
			if ($previous instanceof Request)
			{
				Request::$current = $previous;
			}

			if (isset($benchmark))
			{
				// Delete the benchmark, it is invalid
				Profiler::delete($benchmark);
			}

			// Re-throw the exception
			throw $e;
		}

		// Restore the previous request
		Request::$current = $previous;

		if (isset($benchmark))
		{
			// Stop the benchmark
			Profiler::stop($benchmark);
		}

		// Return the response
		return $request->response();
	}
}