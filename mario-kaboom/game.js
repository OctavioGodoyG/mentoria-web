kaboom({
    global: true, //queda disponible en todos los archivos
    fullscreen: true,
    scale: 2,
    debug: true,
    clearColor: [0, 0, 0, 1],
})

loadSprite('brick', 'assets/brick.png')
loadSprite('coin', 'assets/coin.png')
loadSprite('evil-shroom', 'assets/evil-shroom.png')
loadSprite('block', 'assets/block.png')
loadSprite('mario', 'assets/amador-bros-v4.png')
loadSprite('mushroom', 'assets/mushroom.png')
loadSprite('surprise', 'assets/surprise-block.png')
loadSprite('unboxed', 'assets/unboxed.png')
loadSprite('pipe-top-left', 'assets/pipe-top-left.png')
loadSprite('pipe-top-right', 'assets/pipe-top-right.png')
loadSprite('pipe-bottom-left', 'assets/pipe-bottom-left.png')
loadSprite('pipe-bottom-right', 'assets/pipe-bottom-right.png')

loadSound('mario-theme',"sounds/Super_Mario_Bros.ogg")
loadSound("coin", "sounds/mariobros-coin.ogg");


const MOVE_SPEED = 120
const ENEMY_SPEED = 40
const MUSHROOM_SPEED = 60
const JUMP_FORCE = 360
const JUMP_FORCE_BIG = 570

let isJumping = false

scene("game", () => {

    layers(['bg', 'obj', 'ui'], 'obj')
    const map = [
        '                                  ',
        '                                  ',
        '                                  ',
        '                                  ',
        '                                  ',
        '     %   =*=%=                    ',
        '                                  ',
        '                                  ',
        '                  -+              ',
        '          ^  ^    ()              ',
        '====================     =========',
    ]

    const levelConfig = {
        width: 20,
        height: 20,
        '=': [sprite('brick'), solid()],
        '$': [sprite('coin'), 'coin'],
        '{': [sprite('mushroom'), 'mushroom', body()],
        '}': [sprite('unboxed'), solid()],
        '%': [sprite('surprise'), solid(), scale(0.5), 'coin-surprise'],
        '*': [sprite('surprise'), solid(), scale(0.5), 'mushroom-surprise'],
        '^': [sprite('evil-shroom'), solid(), 'dangerous'],
        '-': [sprite('pipe-top-left'), scale(0.5), solid(), 'pipe'],
        '+': [sprite('pipe-top-right'), scale(0.5), solid(), 'pipe'],
        '(': [sprite('pipe-bottom-left'), scale(0.5), solid(),],
        ')': [sprite('pipe-bottom-right'), scale(0.5), solid(),],
    }
    const gameLevel = addLevel(map, levelConfig)

    const player = add([
        sprite('mario'),
        solid(),
        pos(30, 0),
        body(),
        big(),
        origin('bot'), 
    ])

    play("mario-theme").loop()
    //const music = play("mario-theme")
    //music.play()
    //music.loop()

    function big() {
        let isBig = false
        return {
            getBigger() {
                isBig = true
                this.scale = vec2(2)
            },
        }
    }

    keyDown('left', () => {
        player.move(-MOVE_SPEED, 0)
    })

    keyDown('right', () => {
        player.move(MOVE_SPEED, 0)
    })

    keyDown('space', () => {
        if (player.grounded()) {
            isJumping = true
            if (player.isBig) {
                player.jump(JUMP_FORCE_BIG)
            } else {
                player.jump(JUMP_FORCE)
            }
        }
    })

    player.on("headbump", (obj) => {
        if (obj.is('coin-surprise')) {
            gameLevel.spawn('$', obj.gridPos.sub(0, 1))
            destroy(obj)

            gameLevel.spawn('}', obj.gridPos.sub(0, 0))
        } else if (obj.is('mushroom-surprise')) {
            gameLevel.spawn('{', obj.gridPos.sub(0, 1))
            destroy(obj)
            gameLevel.spawn('}', obj.gridPos.sub(0, 0))
        }
    })

    player.collides('dangerous', (d) => {
        if (isJumping) {
            //matamos
            destroy(d)
            console.log('matamos')
        } else {
            //matamos
            console.log('perdimos')
            go('game_over')

        }
    })

    player.collides('mushroom', (d) => {
        console.log('mario crece')
        destroy(d)
        player.getBigger()
    })

    player.collides('coin', (d) => {
        destroy(d)
        play("coin")
        player.getBigger()
    })

    action('dangerous', (b) => {
        b.move(-ENEMY_SPEED, 0)
    })

    action('mushroom', (b) => {
        b.move(MUSHROOM_SPEED, 0)
    })
})

scene("game_over", () => {
})

start('game')