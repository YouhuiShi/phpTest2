<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Httpful\Request as httpRequest;

class DefaultController extends Controller {
	private $url = "https://novasa.com/api/job/list/1";

	/**
	 * @Route("/", name="homepage")
	 */
	public function indexAction() {
		$response = httpRequest::get( $this->url )
		                       ->expectsJson()
		                       ->withXTrivialHeader( 'Just as a demo' )
		                       ->send();
		$id       = $response->body->id;
		$name     = $response->body->name;
		$products = $response->body->products;

		return $this->render( 'default/index.html.twig', [
			'base_dir' => realpath( $this->getParameter( 'kernel.project_dir' ) ) . DIRECTORY_SEPARATOR,
			'id'       => $id,
			'name'     => $name,
			'products' => $products
		] );
	}

	/**
	 * @Route("/add")
	 */
	public function addAction() {

		$productName = isset( $_POST['productName'] ) ? $_POST['productName'] : "";
		if ( empty( $productName ) ) {
			$this->addFlash( "error", "Product name cannot be empty string." );

			return new RedirectResponse( $this->generateUrl( 'homepage' ) );
		}

		$addUrl       = $this->url . '/products?name=' . $productName;
		$response     = httpRequest::post( $addUrl )->send();
		$responseCode = $response->code;
		if ( $responseCode == 201 ) {
			$this->addFlash( "success", "Product add successfully." );
		} else {
			$this->addFlash( "error", "Unable to add." );
		}

		return new RedirectResponse( $this->generateUrl( 'homepage' ) );
	}

	/**
	 * @Route("/delete")
	 */
	public function deleteAction() {
		$productId = isset( $_GET['id'] ) ? $_GET['id'] : "";

		if ( empty( $productId ) ) {
			$this->addFlash( "error", "Unable to delete." );

			return new RedirectResponse( $this->generateUrl( 'homepage' ) );
		}

		$deleteUrl    = $this->url . '/products/' . $productId;
		$response     = httpRequest::delete( $deleteUrl )->send();
		$responseCode = $response->code;
		if ( $responseCode == 200 ) {
			$this->addFlash( "success", "Delete success." );

			return new RedirectResponse( $this->generateUrl( 'homepage' ) );
		} else {
			$this->addFlash( "error", "Unable to delete." );

			return new RedirectResponse( $this->generateUrl( 'homepage' ) );
		}
	}
}
