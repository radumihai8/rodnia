<div class="class-section">
    <div class="container p-5">
        <div class="row race-content" id="content-warrior">

            <div class="col-md">
                <h1>{{__('Warrior')}}</h1>
                <p>
                    By virtue of their heavy armour, weapons and skills, Warriors play a crucial role in close combat situations.
                    Their two arms aims in life are for raw physical strength combined with a balanced and serene psyche.
                    Depending on their chosen specialisation, Warrios can deal out devastating amounts of damage with two-handed weapons, or skillfully combine shield and sword to neutralise the attacks of multiple enemies.
                </p>
                <img src="{{asset('images/skills/warrior.png')}}" class="img-fluid" alt="">
            </div>
            <div class="col">
                <img class="img-fluid" src="{{asset("images/class_big/warrior.png")}}">
            </div>
        </div>
        <div class="row d-none race-content" id="content-sura">
            <div class="col-md">
                <h1>{{__('Sura')}}</h1>
                <p>
                    Suras are fighters who were blessed with magical powers when they agreed to allow the Seed of Evil to grow in their arms.
                    The magic under their control allows them to inflict damage on their enemies from afar, and they make competent melee fighters thanks to their excellent swordsmanship.
                    Depending on their choice of specialisation, Suras can improve their attack spells or develop additional strengthening spells.
                </p>
                <img src="{{asset('images/skills/warrior.png')}}" class="img-fluid" alt="">
            </div>
            <div class="col">
                <img class="img-fluid" src="{{asset("images/class_big/warrior.png")}}">
            </div>
        </div>
        <div class="row d-none race-content" id="content-ninja">
            <div class="col-md">
                <h1>{{__('Ninja')}}</h1>
                <p>
                    Ninjas are professional killers, capable of carrying out silent and deadly attacks from their ambush.
                    To maximize their speed and agility, these shadowy assassins of the night wear only the lightest armour, so as not to hinder their fleet and fluid movements.
                    Depending on their particular areas of expertise, Ninjas can use their mastery of the dagger in close quarters, or wield a biw abd arror from distance.
                </p>
                <img src="{{asset('images/skills/warrior.png')}}" class="img-fluid" alt="">
            </div>
            <div class="col">
                <img class="img-fluid" src="{{asset("images/class_big/warrior.png")}}">
            </div>
        </div>
        <div class="row d-none race-content" id="content-lycan">
            <div class="col-md">
                <h1>{{__('Lycan')}}</h1>
                <p>
                    Lycans are formidable wolf creatures which were once infected by an incurable virus, losing their human forms and mutating into beasts.
                    Thanks to their unbridled power and heightened instincts they make exeptional close combat fighters.
                    Fearless in the face of conflict, they always seek out the front lines
                </p>
                <img src="{{asset('images/skills/warrior.png')}}" class="img-fluid" alt="">
            </div>
            <div class="col">
                <img class="img-fluid" src="{{asset("images/class_big/warrior.png")}}">
            </div>
        </div>
        <div class="row d-none" id="content-shaman">
            <div class="col-md">
                <h1>{{__('Shaman')}}</h1>
                <p>
                    Employing the wisdom archieve through long years of intense study, the Shamans use spells and magic to attack their foes.
                    Their mystical powers are also of great effect in supporting their allies.
                    Depending on their focus, Shamans can provide a boost to attacks, or instead choose to enhance individual healing and support spells.
                </p>
                <img src="{{asset('images/skills/warrior.png')}}" class="img-fluid" alt="">
            </div>
            <div class="col">
                <img class="img-fluid" src="{{asset("images/class_big/warrior.png")}}">
            </div>
        </div>
    </div>
</div>
<div class="select-class-section">
    <div class="container">

        <div class="row">
            <div class="col-6 col-sm-4 col-lg-2 rotate-col">
                <span class="rotated-class-title-holder">
                    <span class="rotated-class-title">{{__("Select")}}</span>
                    <span class="rotated-class-subtitle"> {{__("Class")}}</span>
                </span>
            </div>
            <div class="col-6 col-sm-4 col-lg-2 text-center race-button race-button-active pt-3 pb-3" id="warrior">
                <div class="race-img-wrapper">
                    <img src="{{asset("images/class_btn/warrior.png")}}">
                </div>
                <p class="mb-0">{{__('Warrior')}}</p>
            </div>
            <div class="col-6 col-sm-4 col-lg-2 text-center race-button pt-3 pb-3" id="sura">
                <div class="race-img-wrapper">
                    <img src="{{asset("images/class_btn/sura.png")}}">
                </div>
                <p class="mb-0">{{__('Sura')}}</p>
            </div>
            <div class="col-6 col-sm-4 col-lg-2 text-center race-button pt-3 pb-3" id="ninja">
                <div class="race-img-wrapper">
                    <img src="{{asset("images/class_btn/ninja.png")}}">
                </div>
                <p class="mb-0">{{__('Ninja')}}</p>
            </div>
            <div class="col-6 col-sm-4 col-lg-2 text-center race-button pt-3 pb-3" id="shaman">
                <div class="race-img-wrapper">
                    <img src="{{asset("images/class_btn/shaman.png")}}">
                </div>
                <p class="mb-0">{{__('Shaman')}}</p>
            </div>
            <div class="col-6 col-sm-4 col-lg-2 text-center race-button pt-3 pb-3" id="lycan">
                <div class="race-img-wrapper">
                    <img src="{{asset("images/class_btn/lycan.png")}}">
                </div>
                <p class="mb-0">{{__('Lycan')}}</p>
            </div>
        </div>
    </div>
</div>


<script>

        //add event listener on click for id warrior
        document.getElementById('warrior').addEventListener('click', function () {
            //select all elements with class race-button
            var elements = document.getElementsByClassName('race-button');
            //loop through elements
            for (const element of elements) {
                element.classList.remove('race-button-active');
            }
            document.getElementById('warrior').classList.add('race-button-active');

            document.getElementById('content-warrior').classList.remove('d-none');
            document.getElementById('content-sura').classList.add('d-none');
            document.getElementById('content-ninja').classList.add('d-none');
            document.getElementById('content-shaman').classList.add('d-none');
            document.getElementById('content-lycan').classList.add('d-none');
        });
        //same for other classes
        document.getElementById('sura').addEventListener('click', function () {
            //select all elements with class race-button
            var elements = document.getElementsByClassName('race-button');
            //loop through elements
            for (const element of elements) {
                element.classList.remove('race-button-active');
            }
            document.getElementById('sura').classList.add('race-button-active');
            document.getElementById('content-warrior').classList.add('d-none');
            document.getElementById('content-sura').classList.remove('d-none');
            document.getElementById('content-ninja').classList.add('d-none');
            document.getElementById('content-shaman').classList.add('d-none');
            document.getElementById('content-lycan').classList.add('d-none');
        });
        document.getElementById('ninja').addEventListener('click', function () {
            //select all elements with class race-button
            var elements = document.getElementsByClassName('race-button');
            //loop through elements
            for (const element of elements) {
                element.classList.remove('race-button-active');
            }
            document.getElementById('ninja').classList.add('race-button-active');
            document.getElementById('content-warrior').classList.add('d-none');
            document.getElementById('content-sura').classList.add('d-none');
            document.getElementById('content-ninja').classList.remove('d-none');
            document.getElementById('content-shaman').classList.add('d-none');
            document.getElementById('content-lycan').classList.add('d-none');
        });
        document.getElementById('shaman').addEventListener('click', function () {
            //select all elements with class race-button
            var elements = document.getElementsByClassName('race-button');
            //loop through elements
            for (const element of elements) {
                element.classList.remove('race-button-active');
            }
            document.getElementById('shaman').classList.add('race-button-active');
            document.getElementById('content-warrior').classList.add('d-none');
            document.getElementById('content-sura').classList.add('d-none');
            document.getElementById('content-ninja').classList.add('d-none');
            document.getElementById('content-shaman').classList.remove('d-none');
            document.getElementById('content-lycan').classList.add('d-none');
        });
        document.getElementById('lycan').addEventListener('click', function () {
            //select all elements with class race-button
            var elements = document.getElementsByClassName('race-button');
            //loop through elements
            for (const element of elements) {
                element.classList.remove('race-button-active');
            }
            document.getElementById('lycan').classList.add('race-button-active');
            document.getElementById('content-warrior').classList.add('d-none');
            document.getElementById('content-sura').classList.add('d-none');
            document.getElementById('content-ninja').classList.add('d-none');
            document.getElementById('content-shaman').classList.add('d-none');
            document.getElementById('content-lycan').classList.remove('d-none');
        });


</script>
