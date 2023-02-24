      <div class="container">
            <div class="row">
              <div class="col-xl-6">
                <div class="contacts-content-box">
                  <div>
                    @if(isset($this->shops[1]))
                    <h3 class="section-title">{{ $this->shops[1]->title }}</h3>
                    <ul class="list-clear mb-3">
                        @if(isset($this->shops[1]->address))
                      <li><span class="ico_pin"></span>
                    <span class="adress-link" data-index="0">
                    {{ $this->shops[1]->address }}
                    </span></li>
                    @endif
                    @if(isset($this->shops[1]->phones))
                        @foreach (json_decode($this->shops[1]->phones,true) as $item_ph)
                    <li><span class="ico_phone"></span>
                        <a href="tel:{{ str_replace('+','',str_replace(' ','',$item_ph)) }}">{{ $item_ph }}</a>
                    </li>
                        @endforeach

                    @endif
                    @if(isset($this->shops[1]->schedule))
                      <li><span class="ico_calendar"></span><span>{{ $this->shops[1]->schedule }}</span></li>
                    @endif
                    </ul>
                    @endif
                    <div class="contacts-tabs">
                      <ul class="nav" role="tablist">
                          @foreach ($contucts as $key => $item)
                          <li class="nav-item" role="presentation"><a class="nav-link @if($key==0)active @endif" id="tab-{{$key+1}}-tab" data-toggle="tab" href="#tab-{{$key+1}}" role="tab" aria-controls="tab-{{$key+1}}" aria-selected="true">{{ $item->title }}</a></li>
                          @endforeach
                      </ul>
                      <div class="tab-content">
                          @foreach ($contucts as $key => $item_c)
                        @if($item_c->getSelf)
                        <div class="tab-pane fade @if($key==0)active show @endif" id="tab-{{$key+1}}" role="tabpanel" aria-labelledby="tab-{{$key+1}}-tab">
                          <div class="contact-card">
                            @if($item_c->getSelf)

                            <div class="contact-card__box">
                              <div class="contact-card__media"><img src="{{ $item_c->getSelf->image ? \Storage::disk('public')->url($item_c->getSelf->image) : '' }}" alt="contact-card"></div>
                              <div class="contact-card__name">
                                  {{ $item_c->getSelf->title }}
                              </div>
                              <div class="contact-card__position">{{ $item_c->getSelf->posada }}</div>
                              <div class="contact-card__list">
                                <ul>
                                    @php
                                        $phon = json_decode($item_c->getSelf->phones,true)
                                    @endphp
                                  <li><span class="ico_phone"></span>
                                    <div>
                                        @if($phon)
                                        @foreach ($phon as $item_ph)
                                            <a href="tel:{{ str_replace('+','',str_replace(' ','',$item_ph)) }}">{{ $item_ph }}</a>
                                        @endforeach
                                        @endif
                                    </div>
                                  </li>
                                  <li><span class="ico_send"></span>
                                    @php
                                        $email = json_decode($item_c->getSelf->emails,true)
                                    @endphp
                                    <div>
                                        @if($email)
                                        @foreach ($email as $item_em)
                                            <a href="mailto: {{ $item_em }}">{{ $item_em }}</a>
                                        @endforeach
                                        @endif
                                    </div>
                                  </li>
                                </ul>
                              </div>
                            </div>
                            @endif

                          </div>
                        </div>
                        @endif
                        @endforeach
                      </div>
                    </div>
                    <div class="mt-4 mb-4 text-center text-md-left">
                        <button class="button button-secondary" type="button" data-toggle="modal"
                                data-target="#modal-feedback">@lang('custom::site.write_to_us')</button>
                    </div>
                  </div>
                  <div>
                    @if(isset($this->shops[0]))

                    <h3 class="section-title">{{ $this->shops[0]->title }}</h3>
                    <ul class="list-clear mb-3">
                      <li class="adress-link"><span class="ico_pin"></span><span class="adress-link" data-index="1">{{ $this->shops[0]->address }}</span></li>
                      @if(isset($this->shops[0]->phones) AND $phones[0]=json_decode($this->shops[0]->phones, true))
                      @foreach ($phones[0] as $item_ph1)
                      <li><span class="ico_phone"></span><a href="tel:{{$item_ph1}}">{{ $item_ph1 }}</a></li>
                      @endforeach
                      @endif
                      @if(isset($this->shops[0]->schedule))
                      <li><span class="ico_calendar"></span><span>{{ $this->shops[0]->schedule }}</span></li>
                        @endif
                    </ul>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-xl-6"></div>
            </div>
          </div>
