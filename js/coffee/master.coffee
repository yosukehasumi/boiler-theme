# Define jQuery
$ = jQuery
# ---------------------------------------------------------------
# Custom Functions...

# Show Main Menu Submenu
showMainMenuSubmenu = (parentMenuItem) ->
  parentMenuItem.addClass 'active'
  subMenuWrapper = parentMenuItem.find('ul.sub-menu').first()
  subMenuWrapper.slideDown 'fast'
  return
# Hide Main Menu Submenu
hideMainMenuSubmenu = (parentMenuItem) ->
  parentMenuItem.removeClass 'active'
  subMenuWrapper = parentMenuItem.find('ul.sub-menu').first()
  subMenuWrapper.slideUp 'fast'
  return
# Hide All Main Menu Submenus
hideAllMainMenuSubmenus = () ->
  $('nav#header-navigation ul.menu > li.menu-item-has-children').removeClass 'active'
  $('nav#header-navigation ul.sub-menu').hide()
  return



# ---------------------------------------------------------------
# ON DOCUMENT READY
$(document).ready ->
  # Initialize Foundation JS
  $(document).foundation()

  # Mobile Menu Toggle
  # $('#mobile-nav-toggle-button').click (e) ->
  #   e.preventDefault()
  #   $('#mobile-navigation').slideToggle 'fast'
  #   $(this).find('i.fa').first().toggleClass('fa-bars').toggleClass('fa-close')

  # Main Menu Mega Menu Dropdown Handler
  $('nav#header-navigation ul.menu > li.menu-item-has-children > a').click (e) ->
    e.preventDefault()
    parentMenuItem = $(this).parent('li.menu-item-has-children')
    if parentMenuItem.hasClass 'active'
      hideMainMenuSubmenu(parentMenuItem)
    else
      hideAllMainMenuSubmenus()
      showMainMenuSubmenu(parentMenuItem)
    return

  # Handling the outside 'clicks' to close all open toggles
  $(document).click (e) ->
    if !$(event.target).closest('nav#header-navigation').length
      return hideAllMainMenuSubmenus()
    return
