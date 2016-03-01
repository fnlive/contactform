<?php
/**
 * class for Contact form message administration.
 */
namespace Fnlive\Contactform;

class ContactFormAdminController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable,
    \Anax\MVC\TRedirectHelpers;

    // TODO: Put message admin in another controller
    /**
     * Initialize the controller.
     *
     * @return void
     */
    public function initialize()
    {
        $this->contactForm = new \Fnlive\Contactform\CContactForm();
        $this->contactForm->setDI($this->di);
    }
    /**
     * Setup initial table for users.
     *
     * @return void
     */
    public function setupAction()
    {
        $this->contactForm->init();
        $this->redirectTo($_SERVER['HTTP_REFERER']);
    }
    /**
     * List all comments for all flows.
     *
     * @return void
     */
    public function listAction()
    {
        $all = $this->contactForm->findAll();
        $this->theme->setTitle("List all messages");
        $this->views->add('contactform/messages', [
            'messages' => $all,
        ]);
    }

    /**
     * Delete a comment.
     *
     * @return void
     */
    public function deleteAction($id = null)
    {
        if (!isset($id)) {
            die("Missing id");
        }

        $res = $this->contactForm->delete($id);
        $this->redirectTo($_SERVER['HTTP_REFERER']);
    }
}
