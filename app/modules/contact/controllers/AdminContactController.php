<?php namespace App\Modules\Contact\Controllers;

use App\Modules\Contact\Models\ContactMessage as ContactMessage;
use HTML, View;

class AdminContactController extends \BackController {

    protected $icon = 'email_open.png';

	public function __construct()
	{
		$this->form['model'] = 'ContactMessage';

		parent::__construct();
	}

    public function index()
    {
        $this->buildIndexForm(array(
            'buttons' => NULL,
            'tableHead' => [t('ID') => 'id', t('New') => 'new', t('Title') => 'title', t('Creator') => 'username', t('Created at') => 'created_at'],
            'tableRow' => function($msg)
            {
                return array(
                    $msg->id,
                    $msg->new ? HTML::image(asset('icons/email_go.png')) : HTML::image(asset('icons/email_open.png')),
                    link_to_route('admin.contact.show', $msg->title, [$msg->id]),
                    $msg->username,
                    $msg->created_at,
                    );
            },
            'actions' => ['delete']
            ));
    }

    public function show($id)
    {
        $msg = ContactMessage::findOrFail($id);

        $msg->new = false;
        $msg->save();

        return $this->pageView('contact::admin_show', compact('msg'));
    }

}