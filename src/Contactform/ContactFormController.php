<?php
/**
 * class for Contact form
 */
namespace Fnlive\Contactform;

class ContactFormController implements \Anax\DI\IInjectionAware
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
     * Display contact form.
     *
     * @param string $route to page for comment flow.
     *
     * @return void
     */
    public function displayAction($redirect = null)
    {
        $this->di->session(); // Will load the session service which also starts the session
        $form = $this->createContactForm();
        $form->check([$this, 'callbackSuccess'], [$this, 'callbackFail']);
        // TODO: How to package template-files into package.
        $this->di->views->add('default/article', [
            'content' => $form->getHTML()
        ]);
    }
    private function createContactForm()
    {
        return $this->di->form->create([], [
            'name' => [
                'type'        => 'text',
                'label'       => 'Name:',
                'required'    => true,
                'validation'  => ['not_empty'],
            ],
            'mail' => [
                'type'        => 'text',
                'required'    => true,
                'label'       => 'Email:',
                'validation'  => ['not_empty', 'email_adress'],
            ],
            'web' => [
                'type'        => 'text',
                'label'       => 'Homepage:',
                'required'    => false,
            ],
            'subject' => [
                'type'        => 'text',
                'required'    => false,
                'label'       => 'Your subject:',
            ],
            'message' => [
                'type'        => 'textarea',
                'label'       => 'Your message:',
                'required'    => false,
            ],
            'submit' => [
                'type'      => 'submit',
                'callback'  => [$this, 'callbackSubmitAddComment'],
            ],
            'submit-fail' => [
                'type'      => 'submit',
                'callback'  => [$this, 'callbackSubmitFailAddComment'],
            ],
        ]);
    }
    /**
     * Callback for submit-button.
     *
     */
    public function callbackSubmitAddComment($form)
    {
        $form->AddOutput("<p>DoSubmit(): Form was submitted.<p>");
        $form->AddOutput("<p>Do stuff (save to database) and return true (success) or false (failed processing)</p>");
        // Save comment to database
        $now = time();
        $this->contactForm->save([
            'name' => $form->Value('name'),
            'mail' => $form->Value('mail'),
            'web' => $form->Value('web'),
            'subject' => $form->Value('subject'),
            'message' => $form->Value('message'),
            'created' => $now,
        ]);

        $form->AddOutput("<p><b>Name: " . $form->Value('name') . "</b></p>");
        $form->AddOutput("<p><b>Email: " . $form->Value('mail') . "</b></p>");
        $form->saveInSession = true;
        return true;
    }
    /**
     * Callback for submit-button.
     *
     */
    public function callbackSubmitFailAddComment($form)
    {
        // TODO: Remove this?
        $form->AddOutput("<p><i>DoSubmitFail(): Form was submitted
            but I failed to process/save/validate it</i></p>");
        return false;
    }
    /**
     * Callback What to do if the form was submitted?
     *
     */
    public function callbackSuccess($form)
    {
        $form->AddOUtput("<p><i>Form was submitted and
            the callback method returned true.</i></p>");
        // Redirect to page posted from.
        // $this->redirectTo($form->Value('flow'));
    }
    /**
     * Callback What to do when form could not be processed?
     *
     */
    public function callbackFail($form)
    {
        $form->AddOutput("<p><i>Form was submitted and
            the Check() method returned false.</i></p>");
        // Redirect to comment form.
        // $this->redirectTo();
    }
}
