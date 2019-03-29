@extends('page.master')
@section('title', 'Contact')
@section ('section-warp')
    <div class="section-warp ask-me">

    </div><!-- End section-warp -->
@endsection

@section('content')

    <div class="col-md-12">
        <div class="page-content">
            <h2 style="color: #fdb655">About Us</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat. Vivamus vulputate posuere nisl quis consequat. Donec congue commodo mi, sed commodo velit fringilla ac. Fusce placerat venenatis mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras ornare, dolor a aliquet rutrum, dolor turpis condimentum leo, a semper lacus purus in felis.</p>
            <div class="widget widget_contact">
                <ul>
                    <li><i class="icon-map-marker"></i>Address :<p>Ask Me Network, School of Information and Communicaion Technology, Nam Ky Khoi Nghia Street, Hoa Quy ward, Ngu Hanh Son district, Da Nang city.</p></li>
                    <li><i class="icon-phone"></i>Phone number :<p>(+84) 0123 456 789</p></li>
                    <li><i class="icon-envelope-alt"></i>E-mail :<p>solutions@gmail.com</p></li>
                    <li>
                        <i class="icon-share"></i>Social links :
                        <p>
                            <a href="#" original-title="Facebook" class="tooltip-n">
                                <span class="icon_i">
                                    <span class="icon_square" icon_size="25" span_bg="#3b5997" span_hover="#2f3239">
                                        <i i_color="#FFF" class="social_icon-facebook"></i>
                                    </span>
                                </span>
                            </a>
                            <a href="#" original-title="Twitter" class="tooltip-n">
                                <span class="icon_i">
                                    <span class="icon_square" icon_size="25" span_bg="#00baf0" span_hover="#2f3239">
                                        <i i_color="#FFF" class="social_icon-twitter"></i>
                                    </span>
                                </span>
                            </a>
                            <a original-title="Youtube" class="tooltip-n" href="#">
                                <span class="icon_i">
                                    <span class="icon_square" icon_size="25" span_bg="#cc291f" span_hover="#2f3239">
                                        <i i_color="#FFF" class="social_icon-youtube"></i>
                                    </span>
                                </span>
                            </a>
                            <a href="#" original-title="Linkedin" class="tooltip-n">
                                <span class="icon_i">
                                    <span class="icon_square" icon_size="25" span_bg="#006599" span_hover="#2f3239">
                                        <i i_color="#FFF" class="social_icon-linkedin"></i>
                                    </span>
                                </span>
                            </a>
                            <a href="#" original-title="Google plus" class="tooltip-n">
                                <span class="icon_i">
                                    <span class="icon_square" icon_size="25" span_bg="#ca2c24" span_hover="#2f3239">
                                        <i i_color="#FFF" class="social_icon-gplus"></i>
                                    </span>
                                </span>
                            </a>
                            <a original-title="RSS" class="tooltip-n" href="#">
                                <span class="icon_i">
                                    <span class="icon_square" icon_size="25" span_bg="#F18425" span_hover="#2f3239">
                                        <i i_color="#FFF" class="icon-rss"></i>
                                    </span>
                                </span>
                            </a>
                            <a original-title="Instagram" class="tooltip-n" href="#">
                                <span class="icon_i">
                                    <span class="icon_square" icon_size="25" span_bg="#306096" span_hover="#2f3239">
                                        <i i_color="#FFF" class="social_icon-instagram"></i>
                                    </span>
                                </span>
                            </a>
                            <a original-title="Dribbble" class="tooltip-n" href="#">
                                <span class="icon_i">
                                    <span class="icon_square" icon_size="25" span_bg="#e64281" span_hover="#2f3239">
                                        <i i_color="#FFF" class="social_icon-dribbble"></i>
                                    </span>
                                </span>
                            </a>
                            <a original-title="Pinterest" class="tooltip-n" href="#">
                                <span class="icon_i">
                                    <span class="icon_square" icon_size="25" span_bg="#c7151a" span_hover="#2f3239">
                                        <i i_color="#FFF" class="icon-pinterest"></i>
                                    </span>
                                </span>
                            </a>
                        </p>
                    </li>
                </ul>
            </div>
        </div><!-- End page-content -->
    </div>

    <div class="col-md-12">
        <div class="page-content">
            <h2 style="color: #fdb655">Say hello !</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat.</p>
            <br>
            <form class="form-style form-style-3 form-style-5 form-js" action="{!! route('post.Contact') !!}" method="post">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <div class="form-inputs clearfix">
                    <p>
                        <label for="name" class="required">Full Name<span>*</span></label>
                        <input type="text" class="required-item" value="" name="fullname" id="fullname" aria-required="true">
                    </p>
                    <p>
                        <label for="mail" class="required">EMail<span>*</span></label>
                        <input type="email" class="required-item" id="email" name="email" value="" aria-required="true">
                    </p>
                </div>
                <div class="form-textarea">
                    <p>
                        <label for="message" class="required">Message<span>*</span></label>
                        <textarea id="message" class="required-item" name="message" aria-required="true" cols="58" rows="7"></textarea>
                    </p>
                </div>
                <p class="form-submit">
                    <input name="submit" type="submit" value="Send" class="submit button small color">
                </p>
            </form>
        </div>
    </div>

@endsection
