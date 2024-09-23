<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ResponsiveUITest extends DuskTestCase
{
    /**
     * Test de la réactivité de l'interface utilisateur sur différents appareils.
     *
     * @return void
     */
    public function testResponsiveUIWithInteractions()
    {
        $this->browse(function (Browser $browser) {
            // Test sur un écran de taille smartphone
            $browser->resize(375, 812) // iPhone X
                    ->visit('/')
                    ->assertSee('Texte d’accueil') // Assurez-vous que le texte de la page d'accueil est visible
                    ->click('.menu-toggle') // Clique sur le bouton de menu mobile
                    ->assertVisible('.mobile-menu') // Vérifie que le menu mobile s'affiche
                    ->click('.mobile-menu a[href="/about"]') // Clique sur un lien dans le menu mobile
                    ->assertPathIs('/about') // Vérifie que la navigation s'est faite correctement
                    ->assertSee('À propos de nous') // Vérifie le texte sur la page "À propos"
                    ->screenshot('iphone-x-interactions');

            // Test sur un écran de taille tablette
            $browser->resize(768, 1024) // iPad
                    ->visit('/')
                    ->assertSee('Texte d’accueil')
                    ->assertVisible('.navbar') // Vérifie que la navbar est visible
                    ->click('.navbar a[href="/contact"]') // Clique sur un lien de la navbar
                    ->assertPathIs('/contact') // Vérifie que la navigation s'est faite correctement
                    ->assertSee('Contactez-nous') // Vérifie le texte sur la page "Contact"
                    ->screenshot('ipad-interactions');

            // Test sur un écran de taille desktop
            $browser->resize(1920, 1080) // Desktop
                    ->visit('/')
                    ->assertSee('Texte d’accueil')
                    ->assertVisible('.navbar') // Vérifie que la navbar est visible
                    ->click('.navbar a[href="/services"]') // Clique sur un lien de la navbar
                    ->assertPathIs('/services') // Vérifie que la navigation s'est faite correctement
                    ->assertSee('Nos Services') // Vérifie le texte sur la page "Services"
                    ->screenshot('desktop-interactions');
        });
    }
}
