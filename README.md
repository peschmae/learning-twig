learning-twig
=============

A small blog, to learn the twig template framework.

It is in no way production ready, and currently I don't intend to push it that far, since there are more than enough
alternatives available.

Most importantly it lacks all security features, since I intend to also abuse the blog to learn more about SQL
injections myself, but also to teach other people about it.

I might implement some security features in the future, but most likely I will use it for proof of concept/
experimental stuff.

Security features I'm interested to implement properly
=============

- [ ] Password hashing with proper random salts
- [ ] Remember-me cookies (single-use token, reset all cookies on attempted session hijacking, on password reset)
- [ ] Forgot password (single-use token via mail, reset all cookies, email notification after change)

Contributions
=============

Since this is intended as a project to learn, I don't accept any contributions from third parties.

If you're just into reading code from someone else, please feel free to do so. If you see something blatantly wrong,
please create an Issue so we can talk about it. I appreciate every feedback, since it helps me to improve my skills.

As I mentioned above, I'm aware that it lacks every security check, so if your Issue is about a security feature
I haven't implemented yet I might just close your ticket without further comment.