# MVC

There are many ways to design an MVC layout. This will have a basic structure
containing:

- Controller (Or the Router)
- View (Renders the Appearance)
- Model (For Business/Database Logic)
- Middleware (For inbetween actions of page loads, eg: security, session
  checking)

I have a baby kicking my face right now, so I will fix this later, lol.

# How this Layout Works
- We keep our private files below the public eye
- The actual Host/VHost would point to the /public/ folder.
